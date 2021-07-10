@extends('layouts.frontLayout.front_design')
<!--YOUTUBE API -->
@include('layouts.frontLayout.youtube_video')


<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')

<section>
		<div class="container" style="margin-top: 10px;">
			<div class="row">
				@if(Session::has('flash_message_alert'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_alert')}}</strong>
        </div>
        @endif 
         @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_success')}}</strong>
        </div>
        @endif 
				<div class="col-sm-3">
					@include('layouts.frontLayout.front_sidebar')
						<div class="left-sidebar" style="margin-top: 5px;"><!--brands_products-->
							<h2 class="left-sidebar">Recipe Video</h2>
							<div style="margin-top: 20px;">
								<div id="player"></div>
							
   </div>
						</div><!--/brands_products-->
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with--thumbnails">
									<a href="{{ asset('images/backend_images/products/large/'.$productDetails->image) }}">
								<img style="width:300px;" class="mainImage" src="{{ asset('images/backend_images/products/medium/'.$productDetails->image) }}" alt="" />
								</a>
							</div>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										<div class="item">
										  <a href=""><img src="images/product-details/similar1.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
										  <a href=""><img src="images/product-details/similar3.jpg" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<form name="addtocartForm" id="addtocartForm" action="{{ url('add-cart')}}" method="post"> {{ csrf_field() }}
								<input type="hidden" name="product_id" value="{{ $productDetails->id }}" >
								<input type="hidden" name="product_name" value="{{ $productDetails->product_name }}" >
								<input type="hidden" name="product_code" value="{{ $productDetails->product_code }}" >
								<input type="hidden" name="product_weight" value="{{ $productDetails->product_weight }}" >
								<input type="hidden" name="price" value="{{ $productDetails->price }}" >
								<input type="hidden" name="product_id" value="{{ $productDetails->id }}" >
								<input type="hidden" name="product_id" value="{{ $productDetails->id }}" >
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $productDetails->product_name }}</h2>
								<p>Code: {{$productDetails->product_code}}</p>
								<p>
									<select id="selState" name="state" style="width:150px;"> 
										<option value="">Select</option>
										@foreach($productDetails->attributes as $state)
										<option value="{{ $productDetails->id}}-{{$state->state}}">{{ $state->state}}</option>
										@endforeach
									</select>
								</p>
								<img src="images/product-details/rating.png" alt="" />
								<span>
									<span>AUS ${{$productDetails->price}}</span>
									<label>Quantity:</label>
									<input type="text" name="quantity" value="1" />
									<button type="Submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Stock:</b><span id="getStock"> </span></p>
							
								
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</form>
						</div>
					</div><!--/product-details-->
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#description" data-toggle="tab">Description</a></li>
								
								
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="description" >
								<div class="col-sm-12">
									<p>{{ $productDetails->description}}
									</p>
								</div>
					
							</div>
							
							<div class="tab-pane fade" id="delivery" >
					
							</div>
							
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									
									<b>Write Your Review</b></p>
									
									<form action="{{ ('/review/'.$productDetails->id) }}" id="contactus" class="contact-form row" name="contactus" method="post">{{ csrf_field()}}
										<span>
											<input id="name" name="name" required="" type="text" placeholder="Your Name"/>
											<input id="email" name="email" required="" type="email" placeholder="Email Address"/>
										</span>
										<textarea id="description" name="description" required=""></textarea>
										
										  <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					
				</div>
			</div>
		</div>
	</section>

@extends('layouts.frontLayout.front_footer')