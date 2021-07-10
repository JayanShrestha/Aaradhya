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
				<h3>YOUR ORDER HAS BEEN CANCELLED</h3>
				<p>Please contact us if there is any enquiry.</p>
				
			</div>
			
		</div>
	</section>


@extends('layouts.frontLayout.front_footer')

<?php
Session::forget('grand_total');
Session::forget('order_id');
?>