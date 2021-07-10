@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Categories</a> <a href="{{url('/admin/view-categories')}}" class="current">View Category</a> </div>
    <h1>Categories</h1>
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
            <h5>View Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Category ID</th>
                  <th>Category Name</th>
                  <th>Category Level</th>
                  <th>Category URL</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($categories as $category)
                <tr class="gradeX">
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}</td>
                  <td >{{ $category->parent_id}}</td>
                  <td>{{ $category->url }}</td>
                  <td class="center"><a href="{{url('/admin/edit-category/'.$category->id)}} " class="btn btn-primary btn-mini">Edit</a> <a id="delCat" href="{{url('/admin/delete-category/'.$category->id)}} " class="btn btn-danger btn-mini">Delete</a></td>
                </tr>
                @endforeach
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Sub Categories</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Sub Category ID</th>
                  <th>Sub Category Name</th>
                  <th>Description</th>
                  <th>Category ID</th>
                  <th>Category URL</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($subCategories as $subcategory)
                <tr class="gradeX">
                  <td>{{ $subcategory->id }}</td>
                  <td>{{ $subcategory->name }}</td>
                  <td style="width:200px;">{{ $subcategory->description}}</td>
                  <td >{{ $subcategory->parent_id}}</td>
                  <td>{{ $subcategory->url }}</td>
                  <td class="center"><a href="{{url('/admin/edit-category/'.$subcategory->id)}} " class="btn btn-primary btn-mini">Edit</a> <a id="delCat" href="{{url('/admin/delete-category/'.$subcategory->id)}} " class="btn btn-danger btn-mini">Delete</a></td>
                </tr>
                @endforeach
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
     

@endsection