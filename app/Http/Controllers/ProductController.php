<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Image;


class ProductController extends Controller
{




  function addProductview(){

    // $products = Product::paginate(3);

   $products = Product::paginate(5, ['*'], 'p1');

   $deletedProducts = Product::onlyTrashed()->paginate(3, ['*'], 'p2');

    // $deletedProducts = Product::onlyTrashed()->paginate(2);


   $categories = Category::all();

   return view('product/view', compact('products','deletedProducts','categories'));

 }

//PRODUCT INSERT SECTION START

 function addproductinsert(Request $request){

  $request->validate([
    'product_name' => 'required',
    'category_id' => 'required',
    'product_description' => 'required',
    'product_price' => 'required|numeric',
    'product_quantity' => 'required|numeric',
    'product_alert' => 'required|numeric'
  ]);


  $lastInsertId = Product::insertGetId([

   'product_name' => $request->product_name,
   'category_id' => $request->category_id,
   'product_description' => $request->product_description,
   'product_price' => $request->product_price,
   'product_quantity' => $request->product_quantity,
   'product_alert' => $request->product_alert 

 ]);


  if ($request->hasFile('product_image')) {
    
    $imageUpload = $request->product_image;

    $fileName = $lastInsertId.'.'.$imageUpload->getClientOriginalExtension();

    Image::make($imageUpload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$fileName));

    Product::find($lastInsertId)->update([

      'product_image' => $fileName

    ]);

  }

  return back()->with('status', 'Data Inserted Successfully');

}

//PRODUCT INSERT SECTION END

//DELETE AND RESTORE SECTION START

function deleteProduct($product_id){

  Product::find($product_id)->delete();

  $msg = 'Product Deleted Successfully!';

  return back()->with('deletestatus', $msg);

}


function restoreProduct($product_id){

 $restore = Product::onlyTrashed()->findorfail($product_id)->restore();

 return back()->withrestorestatus('Product Restored Successfully');
}

function forceDeleteProduct($product_id){

  $forceDelete = Product::onlyTrashed()->findorfail($product_id)->forcedelete();

  return back()->withforcedeletestatus('Product Deleted Permanently');
}

   //DELETE AND RESTORE SECTION END


   //EDIT PRODUCT SECTION START

function editProduct($product_id){

  $products_info = Product::findorfail($product_id);

  return view('product/edit', compact('products_info'));
}



function editProductInsert(Request $request){


  $request->validate([
    'product_name' => 'required',
    'product_description' => 'required',
    'product_price' => 'required|numeric',
    'product_quantity' => 'required|numeric',
    'product_alert' => 'required|numeric'
  ]);


  Product::find($request->product_id)->update([

   'product_name' => $request->product_name,
   'product_description' => $request->product_description,
   'product_price' => $request->product_price,
   'product_quantity' => $request->product_quantity,
   'product_alert' => $request->product_alert 

 ]);



  if($request->hasFile('product_image')){

    if(Product::find($request->product_id)->product_image == 'defaultproductphoto.jpg'){

      $photo_upload = $request->product_image;

      $fileName = $request->product_id.'.'.$photo_upload->getClientOriginalExtension();

      Image::make($photo_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$fileName));

      Product::find($request->product_id)->update([

        'product_image' => $fileName

      ]);

    }

    else{

  //delete old one 

      $deletePhoto = Product::find($request->product_id)->product_image;
      unlink(base_path('public/uploads/product_photos/'.$deletePhoto));

  //upload new

      $photo_upload = $request->product_image;

      $fileName = $request->product_id.'.'.$photo_upload->getClientOriginalExtension();

      Image::make($photo_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$fileName));

      Product::find($request->product_id)->update([

        'product_image' => $fileName

      ]);


    }

  }




  return back()->withupdatestatus('Product Updated Successfully!');


}







//EDIT PRODUCT SECTION END



}
