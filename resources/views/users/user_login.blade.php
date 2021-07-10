
<!-- ==============REGISTRATION============== -->
<html>
<head>
<title>User Login</title>
 
<link rel="stylesheet" href="{{ asset('css/frontend_css/styles.css')}}">
<link rel="stylesheet" href="{{ asset('css/frontend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/frontend_css/passtrength.css') }}" />


      
<style>

 
 body {
    /*background-color: black;*/
 }

form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
/*    padding: 10px 18px;*/
    background-color: #f44336;
}



.container {
    padding: 16px;
}

/*span.psw {
    float: right;
    padding-top: 16px;
}*/


    .cancelbtn {
       width: 100%;
    }
}
</style>

<body>


<div class="container">
<div class="row">

<div class="col-lg-5 col-sm-offset-3" style="background-color:white; box-shadow: 0px 0px 20px 5px #ccc;">

<div class="container" style=" width:100%;">

<div class="col" style="text-align: center; font-size: 30; font-family: "><div></div>  Login Portal</div>
</div>
<hr style="margin-top: 0px; */">

    <div class="col-sm-12">
    <!-- <label><b>Username</b></label> -->
    <form id="loginform" name="loginform" >
    <input type="text" placeholder="User Name" name="uname" required>
    </div>

    <div class="col-sm-12">
    <!-- <label><b>Password</b></label> -->
    <input id="myPassword" type="Password" placeholder="Enter Password" name="psw" required>
    </div>

    <div class="col-sm-12">   
    <button type="submit" style="margin-top:15px;">Login</button>
    <input type="checkbox" checked="checked"> Remember me
    </div>  

      <div class="col-sm-12" style="margin-top:5px; margin-bottom:15px;">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
</form>
  </div>

 <script src="{{ asset('js/frontend_js/jquery-2.1.4.min.js') }}"></script>  
        
        <script src="{{ asset('js/frontend_js/bootstrap.min.js') }}"></script> 
      
<script src="{{ asset('js/frontend_js/jquery.validate.js')}}"></script>
<script src="{{ asset('js/frontend_js/main.js')}}"></script> 
<script src="{{ asset('js/frontend_js/passtrength.js')}}"></script> 

</body>
</html>
