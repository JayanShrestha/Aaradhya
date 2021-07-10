<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Image;
use Auth;
use Session;
use Alaouy\Youtube\Facades\Youtube;

use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\Coupon;
use App\User;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\Review;
use DB;

class ProductsController extends Controller
{
    public function addProduct(Request $request){

    	if($request->isMethod('post')){
		$data = $request->all();
		//echo "<pre>"; print_r($data); die;
if(empty($data['category_id'])){
			return redirect()->back()->with('flash_message_alert','Under category is missing!');
}
		

		$product= new Product;
		$product->category_id = $data['category_id'];
		$product->product_name = $data['product_name'];
		$product->product_code = $data['product_code'];
		$product->product_weight = $data['product_weight'];

		if(!empty($data['description'])){
			$product->description = $data['description'];
		}else{
			$product->description = '';
		} 
		
		$product->price = $data['price'];

		//upload image
		if($request->hasfile('image')){
			$image_tmp = $request->file('image'); 
			if($image_tmp->isValid()){

				$extension = $image_tmp->getClientOriginalExtension();
				$filename = rand(111,99999).'.'.$extension;
				$large_image_path = 'images/backend_images/products/large/'.$filename;
				$medium_image_path = 'images/backend_images/products/medium/'.$filename;
				$small_image_path = 'images/backend_images/products/small/'.$filename;
				//resize image
				Image::make($image_tmp)->save($large_image_path);
				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
				Image::make($image_tmp)->resize(300,300)->save($small_image_path);

				//store image name in products table
				$product->image = $filename;

			}
			
		}

		//$products->image = $filename;
		$product->save();
		
		return redirect('/admin/view-products')->with('flash_message_success','Product has been added successfully!');

}
 //categories drop down start   	
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach($categories as $cat){
    		$categories_dropdown .= "<option value'".$cat->id."'>".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach ($sub_categories as $sub_cat){
    			$categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    		    	}
    		    	// categories drop down end
return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function viewProducts(Request $request){

    	$products = Product::get();
    	foreach ($products as $key => $val) {
    	$category_name = Category::where(['id'=>$val->category_id])->first();
    	$products[$key]->category_name = $category_name->name;
    	}
    	return view('admin.products.view_products')->with(compact('products')); 
    }


    public function editProduct(Request $request, $id=null){

    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;


    		if($request->hasfile('image')){
			$image_tmp = $request->file('image'); 
			if($image_tmp->isValid()){

				$extension = $image_tmp->getClientOriginalExtension();
				$filename = rand(111,99999).'.'.$extension;
				$large_image_path = 'images/backend_images/products/large/'.$filename;
				$medium_image_path = 'images/backend_images/products/medium/'.$filename;
				$small_image_path = 'images/backend_images/products/small/'.$filename;
				//resize image
				Image::make($image_tmp)->save($large_image_path);
				Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
				Image::make($image_tmp)->resize(300,300)->save($small_image_path);

				

			}
			
		}else{
			$filename = $data['current_image'];
		}


    		Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_weight'=>$data['product_weight'],'description'=>$data['description'],'price'=>$data['price'], 'image'=>$filename]);
    		return redirect()->back()->with('flash_message_success','Product has been updated successfully!');
    	}

    	//Get Product Details
    	$productDetails = Product::where(['id'=>$id])->first();

    	//categories drop down start   	
    	$categories = Category::where(['parent_id'=>0])->get();
    	$categories_dropdown = "<option selected disabled>Select</option>";
    	foreach($categories as $cat){

    		if($cat->id==$productDetails->category_id){

    			$selected = "selected";
    		}else{
    			$selected = "";
    		}

    		$categories_dropdown .= "<option value'".$cat->id."' ".$selected.">".$cat->name."</option>";
    		$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
    		foreach ($sub_categories as $sub_cat){
    			if($sub_cat->id==$productDetails->category_id){

    			$selected = "selected";
    		}else{
    			$selected = "";
    		}
    			$categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}
    		    	}
    		    	// categories drop down end

    	return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }

    public function deleteProduct($id=null){
    	Product::where(['id'=>$id])->delete();
    	return redirect()->back()->with('flash_message_alert','Product has been deleted successfully!');

    }

    public function deleteProductImage($id = null){
    	Product::where(['id'=>$id])->update(['image'=>'']);
    	return redirect()->back()->with('flash_message_success','Product Image has been deleted successfully!');
    }


    public function addAttributes(Request $request,$id=null){
    	$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
    	//$productDetails = json_decode(json_encode($productDetails));
    	//echo "<pre>"; print_r($productDetails); die;


    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data);die;

    		foreach ($data['sku'] as $key => $val) {
    			if(!empty($val)){
    				//sku check
    			$attrCountSKU = ProductsAttribute::where('sku', $val)->count();
    			if($attrCountSKU>0){
    				return redirect('admin/add-attributes/'.$id)->with('flash_message_alert','SKU already exists! Please add another SKU.');
    			}

    			// Prevent dubplicate state check
    			$attrCountState = ProductsAttribute::where(['product_id'=>$id,'state'=>$data['state'][$key]])->count();
    			if($attrCountState>0){
    				return redirect('admin/add-attributes/'.$id)->with('flash_message_alert','State already exists! Please add another State.');
    			}

				$attribute = new ProductsAttribute;
				$attribute->product_id = $id;
				$attribute->sku = $val;
				$attribute->state = $data['state'][$key];
				$attribute->stock = $data['stock'][$key];
				$attribute->save();
}
    		}
    		return redirect('admin/add-attributes/'.$id)->with('flash_message_success','Product Attributes has been added successfully!');
    	}
    	return view('admin.products.add_attributes')->with(compact('productDetails'));
    }


    public function deleteAttribute($id = null){
    	ProductsAttribute::where(['id'=>$id])->delete();
return redirect()->back()->with('flash_message_success','Attribute has been deleted successfully!');

    }


    public function editAttributes(Request $request, $id=null){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		foreach ($data['idAttr'] as $key => $attr) {
    			ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['state'=>$data['state'][$key],'stock'=>$data['stock'][$key]]);
    		}
    		return redirect()->back()->with('flash_message_success','Products Attributes Updated successfully!');
    	}

    }





    public function product($id = null){
    	//get product details
    	$productDetails = Product::with('attributes')->where('id',$id)->first();
		
			//echo "<pre>"; print_r($data); die;
			
    	//$productDetails = json_decode(json_encode($productDetails));
    	//echo "<pre>"; print_r($productDetails); die;
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
    	return view('products.detail')->with(compact('productDetails','categories'));
    }

    public function products($url=null){
    		$categoryDetails = Category::where(['url'=>$url])->first();

    		$categories = Category::with('categories')->where(['parent_id'=>0])->get();

    		if($categoryDetails->parent_id==0){	
    			//if url is main category url

    			$subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
    			foreach($subCategories as $subcat){
    			
    				$cat_ids[] = $subcat->id;
    			}

    			$productsAll = Product::whereIn('category_id',$cat_ids)->get();
    			$productsAll = json_decode(json_encode($productsAll));
    			//echo "<pre>"; print_r(($productsAll)); die;
  					
    		}else{
    			//if url is sub category url
    			$productsAll = Product::where(['category_id' => $categoryDetails
    			->id])->get();
    		}

    		return view('products.listing')->with(compact('categories','categoryDetails','productsAll'));

		}


		public function getProductStock(Request $request){
			$data = $request->all();
			//echo "<pre>"; print_r($data); die;
			$proArr = explode("-",$data['idState']);
			//echo $proArr[0]; echo $proArr[1];die;
			$proAttr = ProductsAttribute::where(['product_id'=> $proArr[0], 'state'=> $proArr[1]])->first();
			echo $proAttr->stock;		
		}


		public function addtocart(Request $request){

             Session::forget('CouponAmount');
            Session::forget('CouponCode');

			$data = $request->all();
			//echo "<pre>"; print_r($data); die;



            if(Auth::check()){
               $data['user_email'] = Auth::user()->email;
                
            }
            else{
                $data['user_email'] = '';
                  
               
            }

    $session_id = Session::get('session_id');   
			
            if(empty($session_id)){
                $session_id = Str::random(40);
			     Session::put('session_id',$session_id);
             }

			$stateArr = explode("-",$data['state']);
			//echo $stateArr; die;

           $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],'product_weight'=>$data['product_weight'],'state'=>$stateArr[1],'session_id'=>$session_id])->count();

           if($countProducts>0){
            return redirect()->back()->with('flash_message_alert','Product already exists in cart!');
           }else{

            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'state'=>$stateArr[1]])->first();
           }



			DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getSKU->sku,'product_weight'=>$data['product_weight'],'price'=>$data['price'],'quantity'=>$data['quantity'],'state'=>$stateArr[1],'user_email'=>$data['user_email'],'session_id'=>$session_id]);

			return redirect('cart')->with('flash_message_success','Product has been added in cart!');
		}



		public function cart(){

            if(Auth::check()){
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }
            else{
                  $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
		  
           
			
          //  $productDetails = Product::where(['id'=>$userCart->product_id])->get();
			
            foreach($userCart as $key => $product){
                //echo $product->product_id;
                $productDetails = Product::where('id',$product->product_id)->first();
                $userCart[$key]->image = $productDetails->image;
            }
           // echo "<pre>"; print_r($userCart);
			return view('products.cart')->with(compact('userCart','productsAll'));
		}


        public function deleteCartProduct($id=null){

            Session::forget('CouponAmount');
            Session::forget('CouponCode');

            DB::table('cart')->where('id',$id)->delete();
            return redirect('cart')->with('flash_message_success','Product has been deleted from the cart!');
        }

        Public function updateCartQuantity($id=null, $quantity=null){

             Session::forget('CouponAmount');
            Session::forget('CouponCode');

            $getCartDetails = DB::table('cart')->where('id',$id)->first();
            $getAttributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
           // echo $getCartDetails->product_code; die;
            //$getAttributeStock = array();
            //while($getAttributeStock = mysql_fetch_object($result)){
              //  $getAttributeStock[] = $getAttributeStock;
            //}
           // echo $getAttributeStock->stock; echo"--";
            //echo $updated_quantity = $getCartDetails->quantity+$quantity; die;
            $updated_quantity = $getCartDetails->quantity+$quantity;

            if($getAttributeStock->stock >= $updated_quantity){


            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_message_alert','Product quantity has been updated successfully!');

        }else{
            return redirect('cart')->with('flash_message_success','Required quantity is not available!');
        }
    }
         Public function downCartQuantity($id=null, $quantity=null){

            DB::table('cart')->where('id',$id)->decrement('quantity',$quantity);
            return redirect('cart')->with('flash_message_success','Product quantity has been updated successfully!');

        }

        public function applyCoupon(Request $request){

            Session::forget('CouponAmount');
            Session::forget('CouponCode');


            $data = $request->all();
            $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
            if($couponCount == 0){
                return redirect()->back()->with('flash_message_error','This coupon does not exists!');

            }else
            {
                //Get Coupon details
                $couponDetails= Coupon::where('coupon_code',$data['coupon_code'])->first();
                //if Coupon is inactive
                if($couponDetails->status==0){
                    return redirect()->back()->with('flash_message_error','This coupon is not active!');
                }

                //if coupon is expired
                 $expiry_date = $couponDetails->expiry_date;
               $current_date = date('Y-m-d');
                if( $expiry_date < $current_date ){

                     return redirect()->back()->with('flash_message_error','This coupon is expired!');
                }
                // Coupon is valid for discount
                // check if amount type is fixed or percentage
                // get cart total amount

                if(Auth::check()){
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }
            else{
                  $session_id = Session::get('session_id');
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }
            





             
                $total_amount = 0;
            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price *$item->quantity);

            }

                if($couponDetails->amount_type=="Fixed"){
                    $couponAmount = $couponDetails->amount;


                }else{
                    $couponAmount = $total_amount *($couponDetails->amount/100);
                }

                // Add coupon code & amount in session
                Session::put('CouponAmount',$couponAmount);
                Session::put('CouponCode',$data['coupon_code']);
                 return redirect()->back()->with('flash_message_success','Coupon Code successfully applied. You are availing discount!');

            }

        }

        public function checkout(Request $request){
            $user_id = Auth::user()->id;
             $user_email = Auth::user()->email;
            $userDetails = User::find($user_id);

            $shippingCount = DeliveryAddress::where('user_id',$user_id)->count();
            $shippingDetails = array();
            if($shippingCount>0){

                $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first(); 
            }

            //Update cart table with user email
            $session_id = Session::get('session_id');
            DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);


            if($request->isMethod('post')){

                $data =  $request->all();
                //echo "<pre>"; print_r($data); die;


                if(empty($data['billing_name']) ||  empty($data['billing_address']) ||  empty($data['billing_suburb']) ||  empty($data['billing_state']) ||  empty($data['billing_postcode']) ||  empty($data['billing_mobile']) ||  empty($data['shipping_name']) ||  empty($data['shipping_address']) ||  empty($data['shipping_suburb']) ||  empty($data['shipping_state']) ||  empty($data['shipping_postcode']) ||  empty($data['shipping_mobile']) ){


                    return redirect()->back()->with('flash_message_error','Please fill all fields to Checkout');
                }

                //Update User details
                User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'suburb'=>$data['billing_suburb'],'state'=>$data['billing_state'],'postcode'=>$data['billing_postcode'],'mobile'=>$data['billing_mobile']]);


                if($shippingCount>0){

                    //update Shipping address

                    DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'suburb'=>$data['shipping_suburb'],'state'=>$data['shipping_state'],'postcode'=>$data['shipping_postcode'],'mobile'=>$data['shipping_mobile']]);

                }else{
                    //Add New Shipping Address
                    $shipping = new DeliveryAddress;
                    $shipping->user_id = $user_id;
                    $shipping->user_email = $user_email;
                    $shipping->name = $data['shipping_name'];
                    $shipping->address = $data['shipping_address'];
                    $shipping->suburb = $data['shipping_suburb'];
                    $shipping->state = $data['shipping_state'];
                    $shipping->postcode = $data['shipping_postcode'];
                    $shipping->mobile = $data['shipping_mobile'];
                    $shipping->save();

                }

              return redirect()->action('ProductsController@orderReview');
              

            }


            return view('products.checkout')->with(compact('userDetails','shippingDetails'));
        }



        public function orderReview(){

             $user_id = Auth::user()->id;
             $user_email = Auth::user()->email;
             $userDetails = User::where('id',$user_id)->first();
             $shippingDetails = DeliveryAddress::where('user_id',$user_id)->first(); 
             $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
          //  $productDetails = Product::where(['id'=>$userCart->product_id])->get();
            
            foreach($userCart as $key => $product){
                //echo $product->product_id;
                $productDetails = Product::where('id',$product->product_id)->first();
                $userCart[$key]->image = $productDetails->image;
            }
           


            return view('products.order_review')->with(compact('userDetails','shippingDetails','userCart'));
        }

        public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;
            //get shipping addresses of user
            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();


            if(empty(Session::get('CouponCode'))){
                $coupon_code = '';
            }else{
                $coupon_code = Session::get('CouponCode');
            }


            if(empty(Session::get('CouponAmount'))){
                $coupon_amount = '';
            }else
            {
                $coupon_amount = Session::get('CouponAmount');
            }
           
            $order = new order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->suburb = $shippingDetails->suburb;
            $order->state = $shippingDetails->state;
            $order->postcode = $shippingDetails->postcode;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();


            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){

                $cartPro = new OrdersProduct;
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $pro->product_id;
                $cartPro->product_code = $pro->product_code;
                 $cartPro->product_name = $pro->product_name;
                 $cartPro->product_state = $pro->state;
                  $cartPro->product_weight = $pro->product_weight;
                 $cartPro->product_price = $pro->price;
                 $cartPro->product_quantity = $pro->quantity;
              $cartPro->save();
               

            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if($data['payment_method']=="COD"){
            //if cod redirect user to thanks page after saving order

                $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);

                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);


                $email = $user_email;
                $messageData =[
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails

                ];
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - Aaradhya Pty Ltd');
                });

                Mail::send('emails.invoice',$messageData,function($message) use($email){
                    $message->to($email)->subject('Invoice - Aaradhya Pty Ltd');
                });



            return redirect('/thanks');
        }else
        {
             $productDetails = Order::with('orders')->where('id',$order_id)->first();
                $productDetails = json_decode(json_encode($productDetails),true);

                $userDetails = User::where('id',$user_id)->first();
                $userDetails = json_decode(json_encode($userDetails),true);


                $email = $user_email;
                $messageData =[
                    'email' => $email,
                    'name' => $shippingDetails->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails

                ];
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - Aaradhya Pty Ltd');
                });
                 Mail::send('emails.invoice',$messageData,function($message) use($email){
                    $message->to($email)->subject('Invoice - Aaradhya Pty Ltd');
                });

            return redirect('/paypal');
        }

        }   

        }


        public function thanks(Request $request){

            $user_email = Auth::user()->email;
            DB::table('cart')->where('user_email',$user_email)->delete();
            return view('orders.thanks');
        }

        public function thanksPaypal(){

            return view('orders.thanks_paypal');
        }



        public function paypal(Request $request){
            $user_email = Auth::user()->email;
            DB::table('cart')->where('user_email',$user_email)->delete();
          
            return view('orders.paypal');
        }


        public function cancelPaypal(){
            return view('orders.cancel_paypal');
        }


      

        public function userOrders(){
            $user_id = Auth::user()->id;
            $orders = Order::with('orders')->where('user_id',$user_id)->get();
          /*  $orders = json_decode(json_encode($orders));
            echo "<pre>";print_r($orders); die;*/


            return view('orders.user_orders')->with(compact('orders'));
        }

        public function userOrderDetails($order_id){

            $user_id = Auth::user()->id;
            $orderDetails = Order::with('orders')->where('id',$order_id)->first();
             $orderDetails = json_decode(json_encode($orderDetails));
            /*echo "<pre>";print_r($orderDetails); die;*/

            return view('orders.user_order_details')->with(compact('orderDetails'));
        }

//Admin view order
        public function viewOrders(){
            $orders = Order::with('orders')->get();
            return view('admin.orders.view_orders')->with(compact('orders'));
        }

        public function viewOrderDetails($order_id){

            $orderDetails = Order::with('orders')->where('id',$order_id)->first();
           /*$orderDetails = json_decode(json_encode($orderDetails));
            echo "<pre>";print_r($orderDetails); die;*/
            $user_id= $orderDetails->user_id;
            $userDetails = User::where('id',$user_id)->first();
            /* $userDetails = json_decode(json_encode($userDetails));
             echo "<pre>";print_r($userDetails); die;*/
            return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
        }


          public function viewOrderInvoice($order_id){

            $orderDetails = Order::with('orders')->where('id',$order_id)->first();
          /*  $orderDetails = json_decode(json_encode($orderDetails));
            echo "<pre>";print_r($orderDetails); die;*/
            $user_id= $orderDetails->user_id;
            $userDetails = User::where('id',$user_id)->first();
            return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
        }




        public function updateOrderStatus(Request $request){

            if($request->isMethod('post')){
                $data = $request->all();
                Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
                return redirect()->back()->with('flash_message_success','Order Status has been updated successfully!');
            }
        }


        public function productReview(Request $request,$id=null){

            if($request->isMethod('post')){

                $data = $request->all();    
                $productDetails = Product::where(['id'=>$id])->first();

                $reviewDetails = new Review;
                $reviewDetails->name = $data['name'];
                $reviewDetails->email = $data['email'];
                $reviewDetails->description = $data['description'];
                $reviewDetails->product_code = $productDetails['product_code'];
                $reviewDetails->product_name =  $productDetails['product_name'];
                $reviewDetails->save();
                return redirect()->back()->with('flash_message_success','Your review about this product is with us. Thank you for your feedback');

            }

        }

        public function userviewOrderInvoice($order_id){
             $orderDetails = Order::with('orders')->where('id',$order_id)->first();
          /*  $orderDetails = json_decode(json_encode($orderDetails));
            echo "<pre>";print_r($orderDetails); die;*/
            $user_id= $orderDetails->user_id;
            $userDetails = User::where('id',$user_id)->first();
            return view('invoice.order_invoice')->with(compact('orderDetails','userDetails'));

        }
}

