<html>

<body>
	<table width='700px'>
		<tr><td> &nbsp;</td></tr>
		<tr><td><img src="{{ asset('images/frontend_images/Aaradhya.png')}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{ $name}}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for shopping with us. Your order Invoice is in the link below:-</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td><a href="{{ url('/user-order-invoice/'.$order_id) }}" >Invoice {{ $order_id }}</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			
		</td></tr>
		<tr><td>
			
	<tr><td>&nbsp;</td></tr>
	<tr><td>For any enquiries, you can contact us at <a href="mailto:info@aaradhya.com">info@aaradhya.com</a></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Regards,<br> Team Aaradhya</td></tr>
	<tr><td>&nbsp;</td></tr>

			
		



</table>
</body>
</html>
