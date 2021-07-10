@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Products</a> <a href="{{url('/admin/add-product')}}" class="current">Add Product Attributes</a> </div>
    <h1>Products</h1>
  </div>
  <div class="container-fluid"><hr>
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
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product Attributes</h5>
            
          </div>
          <div class="widget-content nopadding">
          
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'.$productDetails->id)}}" name="add_attribute" id="add_attribute" > {{csrf_field()}}
            
          <input type="hidden" name="product_id" value="{{ $productDetails->id }}">

               

              <div class="control-group">
                <label class="control-label">Product Name</label>
                 <label class="control-label"><strong>{{ $productDetails->product_name }}</strong></label>
                
              </div>

              <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{ $productDetails->product_code }}</strong></label>
              </div>
                
                <div class="control-group">
                <label class="control-label">Product Weight</label>
                 <label class="control-label"><strong>{{ $productDetails->product_weight}}</strong></label>
              </div>

  				<div class="control-group">
                <label class="control-label"></label>
                <div class="field_wrapper">
   				 <div>
       				 <input required type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;" />
       				 <input required type="text" name="state[]" id="state" placeholder="state" style="width:120px;" />
       				 <input required type="text" name="stock[]" id="stock" placeholder="stock" style="width:120px;" />
        		<a href="javascript:void(0);" class="add_button" title="Add field">ADD</a>
    			</div>
			</div>
	
                 
              </div>
             
        

              
              
              <div class="form-actions">
                <input type="submit" value="Add Attributes" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
<div class="row-fluid">
      <div class="span12">
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Attributes</h5>
          </div>
          <div class="widget-content nopadding">
          	<form action="{{ url('/admin/edit-attributes/'.$productDetails->id) }}" method="post">
          		{{csrf_field() }}
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Attribute ID</th>
                  <th>SKU</th>
                  <th>State</th>
                  <th>Stock</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($productDetails['attributes'] as $attributes)
                <tr class="gradeX">
                  <td><input type="hidden" name="idAttr[]" value="{{ $attributes->id }}">{{ $attributes->id }}</td>
                   <td>{{ $attributes->sku }}</td>
                   <td><input type="text" name="state[]" value="{{ $attributes->state }}"></td>
                  <td><input type="text" name="stock[]" value="{{ $attributes->stock }}"></td>
                 
                 
                  <td class="center">
                  	<input type="submit" value="Update" class="btn btn-primary btn-mini"> 
                  <a href="{{url('/admin/delete-attribute/'.$attributes->id)}} " class="btn btn-danger btn-mini">Delete</a></td>
                </tr>

                  @endforeach
             
              </tbody>
            </table>
        </form>
          </div>
        </div>
      </div>
    </div> 

  </div>
</div>
@endsection