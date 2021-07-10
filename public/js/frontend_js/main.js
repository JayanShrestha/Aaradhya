$().ready(function(){


//validate register form on keyup and email
$("#registerform").validate({

	rules:{
		name:{
			required:true,
			minlength:6,
			accept:"[a-zA-Z]+"
		},
		password:{
			required:true,
			minlength:6

		},
		email:{
			required:true,
			email:true,
			remote:"/check-email"
		}
	}, 
	messages:{
		name:{
			required:"Please enter your Name",
			minlength: "Your Name must be atleast 6 characters long"

		},
		password:{
			required:"Please Provide your Password",
			minlength: "Your Password must be atleast 6 character long"
		},
		email:{
			required: "Please enter your Email",
			email: "Please enter valid Email",
			remote: "Email already exists!"
		}
	}
});


//validate account form
$("#accountform").validate({

	rules:{
		name:{
			required:true,
			minlength:2,
			accept:"[a-zA-Z]+"
		},
		address:{
			required:true
			
		},
		suburb:{
			required:true
			
		},
		state:{
			required:true
			
		},
		
		postcode:{
			required:true,
			minlength:4
			
		},
		mobile:{
			required:true,
			minlength:10
			
		}
		
	}, 
	messages:{
		name:{
			required:"Please enter your Name",
			minlength: "Your Name must be atleast 2 characters long",
			accept:"Your Name must contain letters only"

		},
		address:{
			required:"Please Provide your Address",
			minlength: "Your Password must be atleast 1 character long"
		},
		suburb:{
			required: "Please enter your Suburb"
			
		
		},
		state:{
			required: "Please enter your State"
			
		
		},
		postcode:{
			required: "Please enter your Postcode"
			
		
		},
		mobile:{
			required: "Please enter your Mobile Number"
			
		
		}
	}
});

//validate login form on keyup and submit

$("#loginform").validate({

	rules:{
		email:{
			required:true,
			email:true,
			
		},
	
		password:{
			required:true,
			

		}
		
	}, 
	messages:{
		
		
		email:{
			required: "Please enter your Email",
			email: "Please enter valid Email",
			
		},
		password:{
			required:"Please Provide your Password",
			
		}
	}
});



//Password strength script

$('#myPassword').passtrength({
          minChars: 4,
          passwordToggle: true,
          tooltip: true,
          eyeImg :"/images/frontend_images/eye.svg"
        });
//copy billing address to shipping address script

$("#copyAddress").click(function(){
	if(this.checked){
		$("#shipping_name").val($("#billing_name").val());
		$("#shipping_address").val($("#billing_address").val());
		$("#shipping_suburb").val($("#billing_suburb").val());
		$("#shipping_state").val($("#billing_state").val());
		$("#shipping_postcode").val($("#billing_postcode").val());
		$("#shipping_mobile").val($("#billing_mobile").val());

	}
});

});




//Check current user password
$("#current_pwd").keyup(function(){
	var current_pwd = $(this).val();
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		},
		type: 'post',
		url:'/check-user-pwd',
		data: {current_pwd:current_pwd},
		success:function(resp){
			/*alert(resp);*/
			if(resp=="false"){
				$("#chkPwd").html("<font color='red'> Current Password is incorrect</font>");
			}else if(resp=="true"){
				$("#chkPwd").html("<font color='green'> Current Password is correct</font>");
			}
		}, error:function(){
			alert("Error");
		}
	});
});
$("#passwordForm").validate({
		rules:{
			current_pwd:{
				required: true,
				minlength:6,
				maxlength:20
			},
			new_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				
			},
			confirm_pwd:{
				required:true,
				minlength:6,
				maxlength:20,
				equalTo:"#new_pwd"
			}
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});

$(document).ready(function(){
$("#selState").change(function(){
	var idState = $(this).val();
	if(idState == ""){
		return false;
	}
	$.ajax({
		type:'get',
		url:'/get-product-stock',
		data:{idState:idState},
		success:function(resp){
			//alert(resp);
			$("#getStock").html(" In Stock: ("+resp+")");
		},error:function(){
			alert("Error");
		}
	});
	
	
});
});


		// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});

$(window).load(function() { // makes sure the whole site is loaded
$('#status').fadeOut(); // will first fade out the loading animation
$('#preloader').delay(50).fadeOut(100); // will fade out the white DIV that covers the website.
$('body').delay(50).css({'overflow':'visible'});
});




function selectPaymentMethod(){
	if($('#Paypal').is(':checked') || $('#COD').is(':checked')){
		
	}else{
		alert("Please select Payment Method");
		return false;
	}
	
}