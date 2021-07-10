@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
   <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Users</a> <a href="{{url('/admin/dashboard')}}" class="current">View Users</a> </div>
    <h1>Users</h1>
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
            <h5>View Users</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Suburb</th>
                  <th>State</th>
                  <th>Postcode</th>
                  <th>Mobile</th> 
                  <th>Email</th>
                  <th>Status</th>
                  <th>Registered on</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr class="gradeX">
                  <td>{{ $user->id }}</td>
                   <td>{{ $user->name }}</td>
                   <td>{{ $user->address }}</td>
                  <td>{{ $user->suburb }}</td>
                  <td >{{ $user->state}}</td>
                   <td>{{ $user->postcode }}</td>
                  <td>{{ $user->mobile }}</td>
                   <td>{{ $user->email }}</td>
                   <td>
                    @if($user->status==1)
                    <span style="color:green">
                    Active</span>
                    @else
                    <span style="color:red">
                    Inactive</span>
                    @endif
                   </td>
                    <td>{{ $user->created_at }}</td>
                 
                </tr>

                

                @endforeach
             
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
        
     

@endsection
<!--end-main-container-part-->

