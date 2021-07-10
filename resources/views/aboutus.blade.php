@extends('layouts.frontLayout.front_design')

<!------------------------------- contacts ------------------------------------>
@include('layouts.frontLayout.front_header')

	 
	 <div id="contact-page" class="container">
	 @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ session('flash_message_success')}}</strong>
        </div>
        @endif 
    	<div class="bg">
	    	<div class="row">    		
	    		<div class="col-sm-12" class="text-center">    			   			
					<h2 class="title text-center">About <strong>Us</strong></h2>  
					<div class="col-sm-4 center" style="padding-top: 80px;">
					<img style="max-height:80px;"src="{{ asset('images/frontend_images/Aaradhya.png')}}" class="logopogo">  		
					</div>	    				    				
					<div style="margin-top: 200px;" id="gmap" class="contact-map">
						

						<p> We Aaradhya Exim Private Limited is a registered company of Aaradhya group incorporated in the year of 2014 with the experience of 15 years and our company has its based in Pune, Maharashtra.
						We are closely associated with Export and Import of both organic and non-organic tea (Assam Tea) and Indian spices since 2014. Product quality of Aaradhya and the service consistency has been our strength since the beginning. We have been accepted globally for the best service and quality of product offer.
						We have its own-in-house tasting systems apart from certified tasters are known globally. Our products are being tested by certified taster only and handpicked for global clients as per your taste of every region. Our unique blending and post production tasting system has left no opportunity of any inconsistency in the taste and quality of production happened at any season of the year. Our product experts are among the best in the industry which springs us to lead globally.
						Teas as a delightful gift to mankind and spice is the most essential ingredient of one’s kitchen. Both tea and spices and essential component in every household and is a sign of hospitality. A cup of tea unites rich and poor and is above all class distinctions. Realizing the unlimited appeal amongst the tea lovers across the globe for a cup of pure Assam, as it’s known for its rich aroma and unforgettable test, Aaradhya felt responsible to the cause an choose to enter the market in an effort to make a difference by bringing rich taste of pure Assam teas at your door step.
						We have diversified into different varieties of teas as green tea, flavored, Oolong Tea, White tea, Orthodox and Indian spices (Organic and non-organic).
						The unique tastes of tea and flavored tea have been developed in-house for those health-conscious customers in India and abroad. Aaradhya adhering to the corporate ethics and committed to constantly innovate ways and means to delight our valued consumers and customers.
						 </p>
					</div>
				</div>			 		
			</div>    	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Get In Touch</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form action="{{ ('/inquiry') }}"style="margin-top: 150px;" id="contactus" class="contact-form row" name="contactus" method="post">{{ csrf_field()}}
				            <div class="form-group col-md-6">
				                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" class="form-control" required="required" placeholder="Email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
				            </div>
				        </form>
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Contact Info</h2>
	    				<address style="margin-top: 150px;">
	    					<p>Aaradhya Exim Private Limited</p>
							<p>G-06, Ashoka Plaza, Near Hyatt & IBIS Hotel Viman Nagar</p>
							<p>Pune-411014</p>
							<p>Mobile: +61 0449733333</p>
							
							<p>Email: info@aaradhya.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Social Networking</h2>
							<ul>
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div>    			
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
	
	

  
  

 @extends('layouts.frontLayout.front_footer')