@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Reviews</a> <a href="{{url('/admin/view-reviews')}}" class="current">View Reviews</a> </div>
    <h1>Reviews</h1>
    
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Reviews</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th style="width:10px;">Review ID</th>
                  <th style="width:150px;">Name</th>
                  <th style="width:200px;">Email</th>
                  <th >Description</th>
                 
                  <th style="width:200px;">Product Code</th>
                  <th style="width:200px;">Product Name</th>
                   <th style="width:150px;">Date</th>
                
                </tr>
              </thead>
              <tbody>
              	@foreach($reviewDetails as $review)
                <tr class="gradeX">
                  <td>{{ $review->id }}</td>
                   <td>{{ $review->name }}</td>
                   <td>{{ $review->email }}</td>
                  <td>{{ $review->description }}</td>
                  <td >{{ $review->product_code}}</td>
                   <td >{{ $review->product_name}}</td>
                    <td >{{ $review->created_at}}</td>
               
                </tr>

                 
             
          
            
            
          </div>

                @endforeach
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
        



@endsection