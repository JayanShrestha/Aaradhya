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
                    <div class="login-form">
                        <h2>Update Account</h2>
                        <form id="accountform" name="accountform" action="{{ url('/account') }}" method="POST">
                            {{ csrf_field()}}
                            
                            <input value="{{ $userDetails->name}}" id="name" name="name" type="text" placeholder="Name" />
                            <input value="{{ $userDetails->address}}" id="address" name="address" type="text" placeholder="Address" />
                             <input value="{{ $userDetails->suburb}}" id="suburb" name="suburb" type="text" placeholder="Suburb" />
                        <input value="{{ $userDetails->state}}"  id="state" name="state" type="text" placeholder="State" />
                       
                            <input value="{{ $userDetails->postcode
                        }}" id="postcode" name="postcode" type="text" placeholder="Postcode" />
                            <input value="{{ $userDetails->mobile}}" id="mobile" name="mobile" type="text" placeholder="Mobile Number" />
                           
                            <!-- <span>
                                <input type="checkbox" class="checkbox"> 
                                Keep me signed in
                            </span> -->
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                       
                    </div>
                </div>
                <div class="col-sm-1">
                    <h2 class="or">OR</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Update Password </h2>
                       <form id="passwordForm" name="passwordForm" action="{{ url('/update-user-pwd')}}" method="post">{{ csrf_field() }}
                         <input type="password" name="current_pwd" id="current_pwd" placeholder="Current Password">
                         <span id="chkPwd"></span>
                        <input type="password" name="new_pwd" id="new_pwd" placeholder="New Password">
                        <input type="password" name="confirm_pwd" id="confirm_pwd" placeholder="Confirm Password">
                        <button type="submit" class="btn btn-warning"> Update</button>


                       </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->

@extends('layouts.frontLayout.front_footer')