@extends('layouts.frontLayout.front_design')

<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')

<?php use App\Order;
?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Thanks</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				
				
			</div>
		</div>
	</section> 
	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
				<h3>YOUR ORDER HAS BEEN PLACED</h3>
				<p>Your order number is {{ Session::get('order_id')}}  and Total payable amount is $ {{Session::get('grand_total')}}</p>
				<p>Please make payment by clicking on below Payment Button</p>
				<?php
				$orderDetails = Order::getOrderDetails(Session::get('order_id'));
				$orderDetails = json_decode(json_encode($orderDetails));
				//echo "<pre>"; print_r($orderDetails);die;
				$nameArr = explode(' ',$orderDetails->name);
				?>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
					  <input type="hidden" name="cmd" value="_xclick">
					  <input type="hidden" name="business" value="aaradhya@gmail.com">
					  <input type="hidden" name="item_name" value="{{ Session::get('order_id')}}">
					  <input type="hidden" name="currency_code" value="AUD">
					  <input type="hidden" name="amount" value="{{Session::get('grand_total')}}">
					
					  <!-- Set variables that override the address stored with PayPal. -->
					  <input type="hidden" name="first_name" value="{{ $nameArr[0]}}">
					  <input type="hidden" name="last_name" value="{{ $nameArr[1]}}">
					  <input type="hidden" name="address1" value="{{ $orderDetails->address}}">
					  <input type="hidden" name="city" value="">
					  <input type="hidden" name="state" value="">
					  <input type="hidden" name="zip" value="{{ $orderDetails->postcode}}">
					  <input type="hidden" name="country" value="AU">
					  <input type="hidden" name="email" value="{{ $orderDetails->user_email}}">
					  <input type="hidden" name="return" value="{{ url('paypal/thanks') }}">
					  <input type="hidden" name="cancel_return" value="{{ url('paypal/cancel')}}">



					 <!--  <input type "text" name="first_name" value="{{ $nameArr[0]}}">
					  <input type="text" name="last_name" value="{{ $nameArr[1]}}">
					  <input type="text" name="address1" value="{{ $orderDetails->address}}">
					  <input type="text" name="address2" value="">
					  <input type="text" name="city" value="{{$orderDetails->suburb}}">
					  <input type="text" name="state" value="{{$orderDetails->state}}">
					  <input type="text" name="zip" value="{{ $orderDetails->postcode}}">
					
					  <input type="text" name="email" value="{{ $orderDetails->user_email}}">
					 -->

					 
					  <input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_buynow_107x26.png" alt="Buy Now">
					  <img alt="" src="https://paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

			</div>
			
		</div>
	</section>


@extends('layouts.frontLayout.front_footer')

