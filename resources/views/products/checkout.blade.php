@extends('layouts.frontLayout.front_design')

<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')


<section id="form" style="margin-top:20px;"><!--form-->
        <div class="container">
        	 @if(Session::has('flash_message_error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_error')}}</strong>
        </div>
        @endif 
        	<form action="{{ url('/checkout') }}" method="post">{{ csrf_field() }}
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Bill To</h2>
                        <div class="form-group">
                            <input name="billing_name" id="billing_name" @if(!empty($userDetails->name)) value="{{ $userDetails->name }}" @endif type="text" placeholder="Billing Name" class="form-control"/>
                        </div>
                        <div class="form-group">
                        	<input name="billing_address" id="billing_address" @if(!empty($userDetails->address)) value="{{ $userDetails->address }}" @endif type="text" placeholder="Billing Address" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input name="billing_suburb" id="billing_suburb" @if(!empty($userDetails->suburb)) value="{{ $userDetails->suburb }}" @endif type="text" placeholder="Billing Suburb" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input name="billing_state" id="billing_state" @if(!empty($userDetails->state)) value="{{ $userDetails->state }}" @endif type="text" placeholder="Billing State" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input name="billing_postcode" id="billing_postcode" @if(!empty($userDetails->postcode)) value="{{ $userDetails->postcode }}" @endif type="text" placeholder="Billing PostCode" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input name="billing_mobile" id="billing_mobile" @if(!empty($userDetails->mobile)) value="{{ $userDetails->mobile }}" @endif type="text" placeholder="Billing Mobile Address" class="form-control"/>
                        </div>

                        <div class="form-check">
                        	<input value= "{{ $userDetails->name }}"  type="checkbox" class="form-check-input" id="copyAddress">
                        	<label class="form-check-label" for="copyAddress"> Shipping address same as Billing address</label>
                        </div>
                  
                            
                          
                           
                       
                    </div>
                </div>
                <div class="col-sm-1">
                  
                </div>
                <div class="col-sm-4">
                    <div class="signup-form">
                        <h2>Ship To</h2>
                        <div class="form-group">
                            <input @if(!empty($shippingDetails->name)) value=" {{ $shippingDetails->name}}" @endif id="shipping_name" name="shipping_name" type="text" placeholder="Shipping Name" class="form-control"/>
                        </div>
                        <div class="form-group">
                        	<input @if(!empty($shippingDetails->address)) value=" {{ $shippingDetails->address}}" @endif id="shipping_address" name="shipping_address" type="text" placeholder="Shipping Address" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input @if(!empty($shippingDetails->suburb)) value=" {{ $shippingDetails->suburb}}" @endif id="shipping_suburb" name="shipping_suburb" type="text" placeholder="Shipping Suburb" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input @if(!empty($shippingDetails->state)) value=" {{ $shippingDetails->state}}" @endif  id="shipping_state" name="shipping_state" type="text" placeholder="Shipping State" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input @if(!empty($shippingDetails->postcode)) value=" {{ $shippingDetails->postcode}}" @endif id="shipping_postcode" name="shipping_postcode" type="text" placeholder="Shipping PostCode" class="form-control"/>
                        </div>
                        	  <div class="form-group">
                        	<input @if(!empty($shippingDetails->mobile)) value=" {{ $shippingDetails->mobile}}" @endif id="shipping_mobile" name="shipping_mobile" type="text" placeholder="Shipping Mobile Address" class="form-control"/>
                        </div>
                         <div class="form-group">
                        	<button type="submit" class="btn btn-success" /> Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </section>


@extends('layouts.frontLayout.front_footer')