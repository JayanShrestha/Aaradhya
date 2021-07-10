
<!-- ==============REGISTRATION============== -->
<html>
<head>
<title>Registration</title>
  <link href="{{asset('css/frontend_css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('css/frontend_css/bootstrap-theme.min.css')}}" rel="stylesheet"> 
  <link rel="stylesheet" href="{{ asset('css/frontend_css/bootstrap-responsive.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/frontend_css/passtrength.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/frontend_css/passtrength.css') }}" />
       
<style>

  body {
  background: #f1f1f1;
}

  .page-header {
    font-size: 20px;
    margin-left: 6px;
    color:#6e6e6e;
    margin-bottom: -05px;
    border-bottom: none;
  }




  .form-group {
    padding-left: 19px; 
    padding-right: 19px; 
    color:black;
    max-width: 100%;
    margin-top: 14px;
    margin-bottom: 5px;
    font-weight: 700;
  }

  /*.boxx {
    border: 0px solid #ccc;
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 0px;
  }*/

  /*.line {*/
   /*background-image: url(line.jpg);
    background-repeat: repeat-x;
    height: 10px;
    margin-right: 18px; 
    margin-left: 18px;
    width:1100px;

  }




/*#dropdownMenu1 {
  width:450px;
  }*/

/*==============================================
================FOR PLACE HOLDER================
===============================================*/

::-webkit-input-placeholder { /* WebKit, Blink, Edge */
  color:    #cdcdcd;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
  color:    #cdcdcd;
  opacity:  1;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
  color:    #cdcdcd;
  opacity:  1;
}
:-ms-input-placeholder { /* Internet Explorer 10-11 */
  color:   #cdcdcd;
}
::-ms-input-placeholder { /* Microsoft Edge */
  color:    #cdcdcd;
}

/*================================================*/

/*section button {
  margin-top: 23px;
  font-size: 1.7rem;
  padding: 0.5rem 0.5rem; 
  display: block;
  background-color: white;
  border: 1px solid transparent;
  color:#6e6e6e ;
  font-weight: 300;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
  margin-right: 0px;
  height:35px;
  width:99px;
}

section button:hover {
  background-color: #f1f1f1;
  color: #1f1f26;
  border-color: #1f1f26;
}*/


hr {
  border-top: 1px solid #d3d2d2;
  border-bottom: 1px solid #ffffff;
  margin: auto 7px;
}

</style>
</head>
<body>





<div class="row">
  <div class="col-sm-10">

   @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_error')}}</strong>
        </div>
        @endif    
       @if(Session::has('flash_message_success'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_success')}}</strong>
        </div>
        @endif 
      </div>
<div class="col-sm-offset-2 col-sm-10">


<div class="page-header col-sm-10" style="font-size: 28px;">REGISTRATION</div>

<form id="registerform" name="registerform" action="{{url('/user_register')}}" method="POST"> {{ csrf_field() }}
<div class="col-sm-12 page-header">PERSONAL DETAILS</div>
<div class="col-xs-10"><hr></div>     

   


      <!-- ==================================================== -->


    


      
      <div class="form-group col-sm-5" >
        <label for="email">NAME:</label>
        <input id="name" name="name" type="text" class="form-control" placeholder="Name"  />
      </div>
     

  

<!-- ======================================================= -->

   




      <div class="form-group col-sm-5">
        <label for="email">E-MAIL:</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="Email Address" />
      </div>
     
   
    <!-- ==========================================================-->
  <div class="form-group col-sm-5">
        <label for="text">Password:</label>
        <input id="myPassword" name="password" type="password" class="form-control" placeholder="Password"/>
      </div>
       

      

        <div class="form-group col-sm-10 " style="margin-right: 0px"> 
        <section>
            <div class="pull-right">
          <button id="js-trigger-overlay " type="submit">Register</button>
          </div>
        </section>
      </div>

 </form>
   
  <!-- ======================================= -->

   </div>
</div>

<script src="{{ asset('js/frontend_js/jquery-2.1.4.min.js') }}"></script>  
        
        <script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script> 
      
<script src="{{ asset('js/frontend_js/jquery.validate.js')}}"></script>
<script src="{{ asset('js/frontend_js/main.js')}}"></script> 
<script src="{{ asset('js/frontend_js/passtrength.js')}}"></script> 

</body>
</html>
