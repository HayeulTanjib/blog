<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;

class CategoryController extends Controller
{
    function addCategoryView(){
   
        $categories = Category::all();
        
    	return view('category/categoryview', compact('categories'));
    }


    function addCategoryInsert(Request $request){

 $request->validate([
'category_name' => 'required|unique:categories,category_name'
]);

    
if (isset($request->menu_status)) {
	
 Category::insert([
'category_name' => $request->category_name,
'created_at' => Carbon::now(),
'menu_status' => true
   ]);
}
else{

 Category::insert([
'category_name' => $request->category_name,
'created_at' => Carbon::now(),
'menu_status' => false

]);

}

     return back();

    }


// CHANGE MENU STATUS 

  function changeMenuStatus($category_id){
 
//    if(Category::find($category_id)->menu_status == 0){

//    	Category::find($category_id)->update([

// 'menu_status' => true

//    	]);

//    }
//    else{

//    	Category::find($category_id)->update([

// 'menu_status' => false

//    	]);

//    }


$menuStatusInfo = Category::find($category_id);

if($menuStatusInfo->menu_status == 0){

	$menuStatusInfo->menu_status = true;
}
else{

	$menuStatusInfo->menu_status = false;
}

$menuStatusInfo->save();


return back();


  }


}
