<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});


Route::get('/','IndexController@index');


//Product Detail Page
Route::get('/product/{id}','ProductsController@product');

//Cart page
Route::match(['get','post'],'/cart','ProductsController@cart');

//delete product from cart page
Route::get('/cart/delete-product/{id}','ProductsController@deleteCartProduct');


//Add to cart route
Route::match(['get','post'],'/add-cart','ProductsController@addtocart');

//update quantity in cart
Route::get('/cart/update-quantity/{id}/{quantity}','ProductsController@updateCartQuantity');
Route::get('/cart/down-quantity/{id}/{quantity}','ProductsController@downCartQuantity');




//Get Product Attribute stock
Route::get('/get-product-stock','ProductsController@getProductStock');

//Admin login
Route::match(['get','post'],'/admin','AdminController@login');
//Admin Dashboard
Route::get('/admin/dashboard','AdminController@dashboard');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Middleware for security
Route::group(['middleware' => ['adminlogin']],function(){
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/settings','AdminController@settings');
	Route::match(['get','post'],'/admin/check-pwd','AdminController@chkPassword');
	//Admin update password
Route::match(['get','post'],'/admin/update-pwd','Admincontroller@updatePassword');

//Categories Routes (Admin)
Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
Route::get('/admin/view-categories','CategoryController@viewCategories');

//Products
Route::match(['get','post'],'/admin/add-product','ProductsController@addProduct');
Route::match(['get','post'],'/admin/edit-product/{id}','ProductsController@editProduct');
Route::get('/admin/view-products','ProductsController@viewProducts');
Route::get('/admin/delete-product/{id}','ProductsController@deleteProduct');
Route::get('/admin/delete-product-image/{id}','ProductsController@deleteProductImage');


//coupons routes
Route::match(['get','post'],'/admin/add-coupon','CouponsController@addCoupon');
 
Route::get('admin/view-coupons','CouponsController@viewCoupons');

Route::match(['get','post'],'/admin/edit-coupon/{id}','CouponsController@editCoupon');
Route::get('/admin/delete-coupon/{id}','CouponsController@deleteCoupon');



//Admin Orders routes

Route::get('/admin/view-orders','ProductsController@viewOrders');

//route for Admin order details
Route::get('/admin/view-order/{id}','ProductsController@viewOrderDetails');

//Order Invoice
Route::get('/admin/view-order-invoice/{id}','ProductsController@viewOrderInvoice');

//Update Order status
Route::post('/admin/update-order-status','ProductsController@updateOrderStatus');


//view inquiries
Route::get('/admin/view-inquiries','Admincontroller@viewInquiries');

//View review
Route::get('/admin/view-reviews','Admincontroller@viewReviews');

});


//productss Attributes routes
Route::match(['get','post'],'/admin/add-attributes/{id}','ProductsController@addAttributes');

Route::get('/admin/delete-attribute/{id}','ProductsController@deleteAttribute');

Route::match(['get','post'],'/admin/edit-attributes/{id}','ProductsController@editAttributes');






//Admin logout
Route::get('/logout', 'Admincontroller@logout');

//category/listing pages
Route::get('/products/{url}','ProductsController@products');


//User Register/login page
Route::get('/login-register','UserController@userLoginRegister');


//Users Register form submit
Route::post('/user-register','UserController@register'); 

//confirm account
Route::get('confirm/{code}','UserController@confirmAccount');


//Users Login Form submit
Route::post('/user-login','UserController@login');

//Route::match(['Get','POST'],'/login-register','UserController@register');
//Route::match(['GET','POST'],'/user_login','UserController@login');

//check if user already exists
Route::match(['GET','POST'],'/check-email','UserController@checkEmail');

//User Logout
Route::get('/user-logout','UserController@logout');



Route::group(['middleware'=>['frontlogin']],function(){
	//Users Account page
	Route::match(['get','post'],'/account','UserController@account');
	//check user current password
	Route::post('/check-user-pwd','UserController@chkUserPassword');
	//update user password
	Route::post('/update-user-pwd','UserController@updatePassword');

	Route::match(['get','post'],'/checkout','ProductsController@checkout');

	Route::match(['get','post'],'/order-review','ProductsController@orderReview');
	//Place order
	Route::match(['get','post'],'/place-order','ProductsController@placeOrder');
	//Thanks page
	Route::match(['get','post'],'/thanks','ProductsController@thanks');
	//route for paypal
	Route::match(['get','post'],'/paypal','ProductsController@paypal');
	//Users Order Page
	Route::get('/orders','ProductsController@userOrders');
	//User Ordered Product Page
	Route::get('/orders/{id}','ProductsController@userOrderDetails');
	//Paypal thanks page
	Route::get('/paypal/thanks','ProductsController@thanksPaypal');
	//Paypal cancel page
	Route::get('/paypal/cancel','ProductsController@cancelPaypal');
	//Product review

	Route::match(['get','post'],'/review/{id}','ProductsController@productReview');

	//view invoice
	Route::get('/user-order-invoice/{id}','ProductsController@userviewOrderInvoice');




});
//Apply Coupon
Route::post('/cart/apply-coupon','ProductsController@applyCoupon');

//about us

Route::match(['get','post'],'/aboutus','IndexController@aboutus');
Route::match(['get','post'],'/inquiry','IndexController@inquiry');
Route::get('/store-locator','IndexController@storeLocator');