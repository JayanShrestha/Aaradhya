<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/bootstrap.min.css')}}">
   <link rel="stylesheet" href="{{ asset('css/frontend_css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/normalize.css')}}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/animate.css')}}">
  <link rel="stylesheet" href="{{ asset('css/frontend_css/styles.css')}}">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

   <link href="{{ asset('css/frontend_css/prettyPhoto.css')}}" rel="stylesheet">
   <link href="{{ asset('css/frontend_css/price-range.css')}}" rel="stylesheet">

   <link href="{{ asset('css/frontend_css/main.css')}}" rel="stylesheet">
   <link href="{{ asset('css/frontend_css/responsive.css')}}" rel="stylesheet">
   <link href="{{ asset('css/frontend_css/easyzoom.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/frontend_css/passtrength.css') }}" />

 

  <title>AARADHYA PTY LTD</title>

<style>


.dropdown-submenu ul li{
  display: none;
}
.dropdown-submenu li {
  float:left;
}

.dropdown-submenu:hover ul li{
  display: block;
  top: 0;
  left: 100%;
  margin-top: -1px;


 
}


.lightbox {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(0, 0, 0, .5)
}
.toolbarLB {
  text-align: right;
  padding: 3px;
}
.closeLB {
  color: red;
  cursor: pointer;
}
.lightbox .iframeContainer {
  vertical-align: middle;
  background: #CCC;
  padding: 2px;
}
.lightbox.closed {
  display: none;
}

</style>
</head>
<body>  













<!-- content container -->

<script src="{{ asset('js/frontend_js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('js/frontend_js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/frontend_js/script.js')}}"></script>
<script src="{{ asset('js/frontend_js/typewriter.js')}}"></script>
<script src="{{ asset('js/frontend_js/wow.min.js')}}"></script>
<script src="https://use.fontawesome.com/284e13778f.js"></script>
<script src="{{ asset('js/frontend_js/jquery.validate.js')}}"></script>
<script src="{{ asset('js/frontend_js/easyzoom.js')}}"></script> 
<script src="{{ asset('js/frontend_js/main.js')}}"></script>
<script src="{{ asset('js/frontend_js/passtrength.js')}}"></script> 
<script>
 lightBoxClose = function() {
  document.querySelector(".lightbox").classList.add("closed");
}
</script>

</body>
</html>