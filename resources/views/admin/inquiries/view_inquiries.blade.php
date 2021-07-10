@extends('layouts.adminlayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Inquiries</a> <a href="{{url('/admin/view-inquiries')}}" class="current">View Inquiries</a> </div>
    <h1>Inquiries</h1>
    
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>View Inquiries</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th style="width:10px;">Inquiry ID</th>
                  <th style="width:150px;">Name</th>
                  <th style="width:200px;">Email</th>
                  <th style="width:150px;">Subject</th>
                 
                  <th>Message</th>
                   <th style="width:150px;">Date</th>
                
                </tr>
              </thead>
              <tbody>
              	@foreach($inquiryDetails as $inquiry)
                <tr class="gradeX">
                  <td>{{ $inquiry->id }}</td>
                   <td>{{ $inquiry->name }}</td>
                   <td>{{ $inquiry->email }}</td>
                  <td>{{ $inquiry->subject }}</td>
                  <td >{{ $inquiry->message}}</td>
                    <td >{{ $inquiry->created_at}}</td>
               
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