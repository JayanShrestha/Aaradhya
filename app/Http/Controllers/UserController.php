<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Suburb;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

	Public function userLoginRegister(Request $request){
		

		return view('users.login_register');
	}

    public function register(Request $request){
    	if($request->isMethod('post')){
    		$data = $request-> all();
    		//user check if exists
    		$userscount = User::where('email',$data['email'])->count();
    	if($userscount>0){
    		return redirect()->back()->with('flash_message_error','Email already exists!');
    		}else{
    			$user = new User;
    			$user->name = $data['name'];
                $user->address = Null;
                $user->suburb = Null;
                $user->state = Null;
                $user->postcode = Null;

    			$user->email = $data['email'];

    			$user->password = bcrypt($data['password']);
    			$user->save();

           /*     //send register email
                $email = $data['email'];
                $messageData = ['email'=>$data['email'],'name'=>$data['name']];
                Mail::send('emails.register',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Registration with Aaradhya Pty Ltd');
                });
*/          
                 $email = $data['email'];
                  $messageData = ['email'=>$data['email'],'name'=>$data['name'],'code'=>base64_encode($data['email'])];
                  Mail::send('emails.confirmation',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Confirm with Aaradhya Pty Ltd');
                });

                  return redirect()->back()->with('flash_message_success','Please confirm your email to activate your acccount!');
    			if(Auth::Attempt(['email'=>$data['email'],'password'=>$data['password']])){
                    Session::put('frontSession',$data['email']);


                     if(!empty(Session::get('session_id'))){
                         $session_id = Session::get('session_id');
                        DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);

                        }

    			return redirect('/cart');
    			}
    		}
    	}
    		
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           /* echo "<pre>";print_r($data); die;*/

           if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
            $userStatus = User::where('email',$data['email'])->first();
            if($userStatus->status == 0){
                return redirect()->back()->with('flash_message_error','Your account is not activated! Please confirm your email to activate.');
            }
            Session::put('frontSession',$data['email']);


             




            if(!empty(Session::get('session_id'))){
            $session_id = Session::get('session_id');
            DB::table('cart')->where('session_id',$session_id)->update(['user_email'=>$data['email']]);

}
            return redirect('/cart');
           }else{
            return redirect()->back()->with('flash_message_error','Invalid Username or Password');
           }


        }
    }


    Public function logout(){

        Auth::logout();
        Session::forget('frontSession');
        Session::forget('session_id');
        return redirect('/');

    	}
    

    public function confirmAccount($email){
       $email = base64_decode($email);
        $userCount = User::where('email',$email)->count();
        if($userCount>0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status == 1){
                return redirect('login-register')->with('flash_message_success','Your Email account is already activated. You can login now.');
            
        }else{

            User::where('email',$email)->update(['status'=>1]);

                  
                  $messageData = ['email'=>$email,'name'=>$userDetails->name];
                  Mail::send('emails.welcome',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Welcome to Aaradhya Pty Ltd');
                });



            return redirect('login-register')->with('flash_message_success','Your Email account is now activated. You can login now.');
        }

    }else{
        abort(404);
    }
    }





    public function account(Request $request){
        $user_id = Auth::user()->id;
        $userDetails = User::find($user_id);
    

        $suburbs = Suburb::get();


        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['name'])){

  return redirect()->back()->with('flash_message_error','Please enter your Name to update your account details');
            }
             if(empty($data['address'])){

  return redirect()->back()->with('flash_message_error','Please enter your Address to update your account details');
            }
             if(empty($data['suburb'])){

  return redirect()->back()->with('flash_message_error','Please enter your Suburb to update your account details');
            }
             if(empty($data['state'])){

  return redirect()->back()->with('flash_message_error','Please enter your State to update your account details');
            }
             if(empty($data['postcode'])){

  return redirect()->back()->with('flash_message_error','Please enter your PostCode to update your account details');
            }
             if(empty($data['mobile'])){

  return redirect()->back()->with('flash_message_error','Please enter your Mobile Number to update your account details');
            }

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->suburb = $data['suburb'];
            $user->state = $data['state'];
            $user->postcode = $data['postcode'];
            $user->mobile = $data['mobile'];
         
            $user->save();
            return redirect()->back()->with('flash_message_success','Your account details has been successfully updated!');
        }

        return view ('users.account')->with(compact('suburbs','userDetails'));
    }


    public function chkUserPassword(Request $request){
        $data = $request->all();
        /*echo"<pre>"; print_r($data);die;*/
        $current_password = $data['current_pwd'];
        $user_id = Auth::User()->id;
        $check_password = User::where('id',$user_id)->first();
        if(Hash::check($current_password,$check_password->password)){
            echo "true"; die;
        }else{
            echo "false"; die;
        }
    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $old_pwd = User::where('id',Auth::user()->id)->first();
            $current_pwd = $data['current_pwd'];
            if(Hash::check($current_pwd,$old_pwd->password)){
                //update password
                $new_pwd = bcrypt($data['new_pwd']);
                User::where('id',Auth::user()->id)->update(['password'=>$new_pwd]);
                 return redirect()->back()->with('flash_message_success','Password Updated successfully!');
            }else{
                return redirect()->back()->with('flash_message_error','Current Password is Incorrect!');
            }

        }
    }

  
   public function checkEmail(Request $request){
    
//check if user already exists
    $data = $request-> all();
    	$userscount = User::where('email',$data['email'])->count();
    	if($userscount>0){
   		echo"false";
   	}else{
   		echo "true";die;
   	}

   }





}