@extends('layouts.frontLayout.front_design')

<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')
  

<!-- ------------------------------------------------Banner--------------------------------------------- -->

<div class="container-fluid banner1 col-xs-12">


    <h1  class="shadow welcome col-xs-12">Welcome to <span style="color:#5bc0de;">Aaradhya</span> <span style="color:#ff6600;"> Exim</span><span style="color:#75FF33;"> Pty Ltd</span></h1>

    <div class="typewriter">
      <h1 class="typewriter shadow typing" style="font-weight:bold;margin-top:15px;">"See what you need,and get it delivered"</h1></div>
      <p class="typewriter shadow subtitle">Get Groceries from us to Your Home</p>
      <br>
      <div class="text-center button10">
      <button class="btn btn-primary-outline" style="margin-bottom:50px;"><a href="#FirstRow" class="headbox" style="margin: 0 0 1px;">EXPLORE</a> </button>
    </div>
</div>


<div class="container margn" style="margin-top: 20px;">
<div class="row">
<div class="col-sm-12">
        <div class="section-header" style="padding-left: 20px;">
          <div style="font-weight: bold; font-family: denmark; font-size: 30px; margin-top:20px;">Products Selected by our Popularity</div>
          <p style="font-family:georgia; font-size: 17px; ">Discover new stores all over the corners of Australia.</p>
        </div>
        <div class="col-xs-12"><hr></div>

</div>
</div>
</div>    

<!------------------------------------------First Row---------------------------------------->

<div class="container margn" style="margin-top: 0px;">
<div class="row">
<div class="col-sm-3" style="margin-top: 100px;">
@include('layouts.frontLayout.front_sidebar')
      </div>

<div class="col-sm-9 padding-right" style="margin-top: 100px;">
   <h2> {{$categoryDetails->name}}</h2>
          <div class="features_items"><!--features_items-->
         

            @foreach($productsAll as $product)
            <div class="col-sm-4">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                      <a href="{{ url('/product/'.$product->id)}}"><img style="width:200px;" src="{{ asset('images/backend_images/products/small/'.$product->image) }}" alt="" /></a>
                                          <div class="product-overlay">
                        <div class="overlay-content">
                      <h2>${{ $product->price }}</h2>
                      <p>{{ $product->product_name }}</p>
                      <a href="{{ url('product/'.$product->id)}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>

                    </div>
                  </div>
                </div>
                    <!--<div class="product-overlay">
                      <div class="overlay-content">
                        <h2>${{ $product->price}}</h2>
                        <p>{{ $product->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                      </div>
                    </div> -->
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    
                  </ul>
                </div>
              </div>
            </div>

            @endforeach

          </div>
        </div>
<!--===============================Row Ends================================-->

<!-- -----------------------------Footer Div-------------------------------->

@extends('layouts.frontLayout.front_footer')