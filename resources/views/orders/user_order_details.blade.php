@extends('layouts.frontLayout.front_design')

<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')


<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li ><a href="{{ url('orders')}}">Orders</a></li>
                   <li class="active">{{ $orderDetails->id}}</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				
				
			</div>
		</div>
	</section> 
	<section id="do_action">
		<div class="container">
			<div class="heading" align="center">
			<table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                 <th>Product State</th>
              <th>Product Weight</th>
                  <th>Product Price</th>
                   <th>Product Quantity</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($orderDetails->orders as $pro)
            <tr>
                <td>{{ $pro->product_code}}</td>
                <td>
                	{{ $pro->product_name}}
                </td>
                <td>{{ $pro->product_state}}</td>
                <td>{{ $pro->product_weight}}</td>
                <td>{{ $pro->product_price}}
               
                  <td>{{ $pro->product_quantity}}</td>
            </tr>
            @endforeach
      
    </table>
			</div>
			
		</div>
	</section>


@extends('layouts.frontLayout.front_footer')

