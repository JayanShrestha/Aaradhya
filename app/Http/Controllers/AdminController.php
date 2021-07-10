<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Session;
use App\User;
use App\Admin;
use App\Inquiry;
use App\Review;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->input();
           $adminCount = Admin::where(['username'=>$data['username'],'password'=>md5($data['password']),'status'=>1])->count();
    	if($adminCount>0){
            Session::put('adminSession',$data['username']);
            return redirect('/admin/dashboard');
        }
             
    			
    		
    		else
    		{
    			return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
    		}
    	}
    	return view('admin.admin_login');
    }

    public function dashboard(){
//if(Session::has('adminSession')){
    //perform all dashboard tasks
//}else{
  //  return redirect('/admin')->with('flash_message_error','Please login to access');

        $users = User::get();


//}
        return view('admin.dashboard')->with(compact('users'));
    }

    public function settings(){
        $adminDetails = Admin::where(['username'=>Session::get('adminSession')])->first();
        return view('admin.settings')->with(compact('adminDetails'));
    }

    public function chkPassword(Request $request){

        $data = $request->all();
      
       
          $adminCount = Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
      if($adminCount == 1){
        echo "true"; die;
      }else{
        echo "false"; die;
      }
  }

//update password
    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
           $adminCount = Admin::where(['username'=>Session::get('adminSession'),'password'=>md5($data['current_pwd'])])->count();
           if($adminCount == 1){
           $password= md5($data['new_pwd']);
          Admin::where('username',Session::get('adminSession'))->update(['password'=>$password]);
           return redirect('/admin/settings')->with('flash_message_success','Password updated Successfully!');
        }else{
            return redirect('/admin/settings')->with('flash_message_error','Incorrect Current Password!');
        }
        }
    }
    public function logout(){

    Session::flush();
    return redirect('/admin')->with('flash_message_success','Logged Out Successfully');
    }


    //VIew inquiries
    public function viewInquiries(){
      $inquiryDetails=Inquiry::get();
      return view('admin.inquiries.view_inquiries')->with(compact('inquiryDetails'));


    }

    public function viewReviews(){
      $reviewDetails = Review::get();
       return view('admin.reviews.view_reviews')->with(compact('reviewDetails'));
    }
}
