@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="{{url('/admin/view-products')}}" class="current">View Products</a> </div>
    <h1>Products</h1>
    	@if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_success')}}</strong>
        </div>
        @endif 
        @if(Session::has('flash_message_alert'))
        <div class="alert alert-alert alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_alert')}}</strong>
        </div>
        @endif 
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Product ID</th>
                  <th>SubCategory ID</th>
                  <th>SubCategory Name</th>
                  <th>Product Name</th>
                  <th>Product Code</th>
                  <th>Product Weight</th>
                  <th>Price</th> 
                  <th>Image</th>
                  <th>Channel ID</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($products as $products)
                <tr class="gradeX">
                  <td>{{ $products->id }}</td>
                   <td>{{ $products->category_id }}</td>
                   <td>{{ $products->category_name }}</td>
                  <td>{{ $products->product_name }}</td>
                  <td >{{ $products->product_code}}</td>
                   <td>{{ $products->product_weight }}</td>
                  <td>{{ $products->price }}</td>
                  <td>
                    @if(!empty($products->image))
                    <img src="{{ asset('/images/backend_images/products/small/'.$products->image) }}" style="width:60px;">
                    @endif
                   </td>
                   <td>{{ $products->channelId}}</td>
                  <td class="center"> <a href="#myModal{{ $products->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a>
                   <a href="{{url('/admin/edit-product/'.$products->id)}} " class="btn btn-primary btn-mini">Edit</a> 
                    <a href="{{ url('/admin/add-attributes/'.$products->id) }}" class="btn btn-success btn-mini">Add</a><a id="delProduct" href="{{url('/admin/delete-product/'.$products->id)}} " class="btn btn-danger btn-mini">Delete</a></td>
                </tr>

                 
                    <div id="myModal{{ $products->id }}" class="modal hide">
                       <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>{{ $products->product_name }}</h3>
              </div>
              <div class="modal-body">
                <p>Product ID: {{ $products->id }}</p>
                 <p>Category ID: {{ $products->category_id }}</p>
                  <p>Product Code: {{ $products->product_code }}</p>
                   <p>Product Weight: {{ $products->product_weight }}</p>
                    <p>Price: {{ $products->price }}</p>
                     <p>Description: {{ $products->description }}</p>
              </div>
          
            
            
          </div>

                @endforeach
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
        
     

@endsection