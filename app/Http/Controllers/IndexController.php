<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\User;
use App\Map;
Use Auth;
use DB;
use App\Inquiry;
class IndexController extends Controller
{
   public function index(){
   	$productsAll = Product::inRandomOrder()->get();

   	//get all categories
   	$categories = Category::with('categories')->where(['parent_id'=>0])->get();
   	//$categories = json_decode(json_encode($categories));
   	//echo '<pre>'; print_r($categories); die;
   /*	$categories_menu ="";
   	foreach($categories as $cat){
   		
   		$categories_menu .= "<div class='panel-heading'>
									<h4 class='panel-title'>
										<a data-toggle='collapse' data-parent='accordian' href='#".$cat->id."'>
											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
											".$cat->name."
										</a>
									</h4>
								</div>
								<div id='".$cat->id."' class='panel-collapse collapse'>
									<div class='panel-body'>
										<ul>";
										$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
   										foreach($sub_categories as $subcat){	
   										
   										$categories_menu .= "<li><a href='".$subcat->url." '>".$subcat->name." </a></li>";
   											}
											
											$categories_menu .="</ul>
										
									</div>
								</div>";
   		

   	}*/
     

   	return view('index')->with(compact('productsAll','categories','username'));
   }


   public function aboutus(Request $request){

      
   	return view('aboutus');
   }

   public function inquiry(Request $request){
     if($request->isMethod('Post')){
         $data = $request->all();
        

         $inquiryDetails= new Inquiry;
        
               $inquiryDetails->name = $data['name'];
                $inquiryDetails->email = $data['email'];
                $inquiryDetails->subject = $data['subject'];
                $inquiryDetails->message = $data['message'];

                $inquiryDetails->save();

                return redirect()->back()->with('flash_message_success','Your inquiry is with us now! We will get back to you. Thank you');
              

          
              
      }

   }
   public function storeLocator(){
      $mapDetails=Map::first();
      return view('users.store_locator')->with(compact('mapDetails'));
   }
}
