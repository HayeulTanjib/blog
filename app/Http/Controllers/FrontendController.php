<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Contact;
use App\Mail\ContactMessage;
use Mail;
use App\Cart;
use Carbon\Carbon;

class FrontendController extends Controller
{

   function home(){

    $products = Product::all();

    $categories = Category::all();

   	return view('welcome', compact('products','categories'));

   }

   function productDetails($product_id){

$singleProductInfo = Product::findorfail($product_id);

return view('frontend/productdetails',compact('singleProductInfo'));

   }


   function categoryWiseProduct($category_id){

   
   $category_product = Product::where('category_id',$category_id)->get();

   $categoryName = Category::find($category_id);

    return view('frontend/categorywiseproduct',compact('category_product','categoryName'));
    
   }



   function contactView(){

    return view('contact');
   }


   function contactInsert(Request $request){

Contact::insert($request->except('_token'));

$message = $request->message;


Mail::to('oniket77@gmail.com')->send(new ContactMessage($message));

return back()->withmailstatus('Mail Sent Successfully!');


   }



   //ADD TO CART

   function addToCart($product_id){


    $ipAddress = $_SERVER['REMOTE_ADDR'];


    if(Cart::where('customer_ip',$ipAddress)->where('product_id',$product_id)->exists()){
      
       Cart::where('customer_ip',$ipAddress)->where('product_id',$product_id)->increment('product_quantity',1);
    }

    else{

 Cart::insert([

'customer_ip' => $ipAddress,
'product_id' => $product_id,
'created_at' => Carbon::now()

    ]);

    }
return back();
   }

   function cart(){

$cartIteams = Cart::where('customer_ip',$_SERVER['REMOTE_ADDR'])->get();

 return view('frontend/cart',compact('cartIteams'));
   }


   function deleteFromCart($cart_id){

    Cart::where('product_id',$cart_id)->delete();

    return back();
   }


   function clearCart(){

    Cart::where('customer_ip', $_SERVER['REMOTE_ADDR'])->delete();

    return back();
   }




}
