@extends('layouts.frontLayout.front_design')

<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')
  
<section id="form" style="margin-top:0px;"><!--form-->
        <div class="container">
            <div class="row">
                @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block" style="color: #b94a48;
    background-color: #f2dede;
    border-color: #eed3d7;">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_error')}}</strong>
        </div>
        @endif    
       @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block" style="color: #468847;
    background-color: #dff0d8;
    border-color: #d6e9c6;">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_success')}}</strong>
        </div>
        @endif 
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Login to your account</h2>
                        <form id="loginform" name="loginform" action="{{ url('/user-login') }}" method="POST">
                            {{ csrf_field()}}
                            
                            <input id="email" name="email" type="email" placeholder="Email Address" />
                            <input id="password" name="password" type="password" placeholder="Password"/>
                            <!-- <span>
                                <input type="checkbox" class="checkbox"> 
                                Keep me signed in
                            </span> -->
                            <button type="submit" class="btn btn-default">Login</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form id="registerform" name="registerform" action="{{ url('/user-register')}}" method="POST">
                            {{ csrf_field() }}
                            <input id="name" name="name" type="text" placeholder="Name"/>
                            <input id="email" name="email" type="email" placeholder="Email Address"/>
                            <input id="myPassword" name="password" type="password" placeholder="Password"/>
                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@extends('layouts.frontLayout.front_footer')