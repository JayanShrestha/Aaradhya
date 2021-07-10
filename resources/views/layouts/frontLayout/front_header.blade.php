<?php
use App\Http\Controllers\Controller;
$mainCategories = Controller::mainCategories();
 if(Auth::check()){
    $user_email = Auth::user()->email;
      $username =DB::table('users')->where('email',$user_email)->first();
   }else{
      $username='';
   }

?>
  <div class="container-fluid block1" style="height: 40px;">
    <div class="row">
     <div class="Headerrr" style="height:; background-color: white; box-shadow: 0px 1px 4px #ffffff;">

            <div class="col-md-3" id="call-us" style="margin-top: 4px;" >
              <span class="btn btn-link glyphicon glyphicon-earphone" style=""></span>
              CALL US +61 0449733333 
            </div>

            <div class="col-md-3  pull-right">
              <ul class="pull-right">
                @if(!empty(Auth::check()))
                <li class="btn btn-link"><a href="#" style="font-size: 15px; color:black;"></a>Welcome {{ $username->name}}</li>
                @endif
                <li class="btn btn-link glyphicon glyphicon-heart" style="font-size: 20px;"><a href="#"></a></li>
               <a href="{{ url('/cart')}}" > <li class="btn btn-link glyphicon glyphicon-shopping-cart" style="font-size: 20px;"></a></li>
              </ul>
            </div>
      
    </div>
  </div>
</div>

  <div class="header-middle"><!--header-middle-->
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="logo pull-left">
               <a href="{{url('/')}}"> 
                     <img style="max-height:80px;"src="{{ asset('images/frontend_images/Aaradhya.png')}}" class="logopogo">
                   </a>
            </div>
           
          </div>
          <div class="col-sm-8">
            <div class="shop-menu pull-right">
              <ul class="nav navbar-nav">
              
                <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                <li><a href="{{ url('/orders')}}"><i class="fa fa-crosshairs"></i> Orders</a></li>
                <li><a href="{{url('/cart') }}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                @if(empty(Auth::check()))


                <li><a href="{{ url('/login-register') }}"><i class="fa fa-lock"></i> Login</a></li>
                @else
                  <li><a href="{{ url('/account') }}"><i class="fa fa-user"></i> Account</a></li>
                  <li><a href=" {{ url('/user-logout')}} "><i class="fa fa-sign-out"></i> Logout</a></li>
                @endif
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div><!--/header-middle-->
<div style="background-color: #ff6600; margin-top: 15px;" class="header-bottom"><!--header-bottom-->
      <div class="container">
        <div class="row">
          <div class="col-sm-9">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div class="mainmenu pull-left">
              <ul class="nav navbar-nav collapse navbar-collapse">
                <li><a href="{{ url('/')}}" class="active" style="color:white;"><strong>Home</strong></a></li>
                <li class="dropdown"><a href="#" style="color:white;"><strong>Categories</strong><i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="color:white;">
                                        @foreach($mainCategories as $cat)
                                        <li><a href="{{ asset('products/'.$cat->url) }}"><strong>{{ $cat->name}} </strong></a><li>
                                          @endforeach
                                       
                                    </ul>
                                </li> 
                                <li><a href="{{ url('/store-locator')}}" style="color:white;"><strong>Store Locater</strong></a></li>  
                <li><a href="{{ url('/aboutus') }}" style="color:white;"><strong>About Us</strong></a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-3">
            
          </div>
        </div>
      </div>
    </div><!--/header-bottom-->
<div id="preloader"> 
  <div id="status">
  </div> 
</div>
