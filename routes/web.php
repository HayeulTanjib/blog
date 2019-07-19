<?php

Route::get('add/product/view', 'ProductController@addproductview');

Route::post('add/product/insert', 'ProductController@addproductinsert');

Route::get('/delete/product/{product_id}', 'ProductController@deleteProduct');

Route::get('/edit/product/{product_id}', 'ProductController@editProduct');

Route::post('delete/product/insert', 'ProductController@editProductInsert');

Route::get('restore/product/{product_id}', 'ProductController@restoreProduct');

Route::get('forcedelete/product/{product_id}', 'ProductController@forceDeleteProduct');


//Category
Route::get('add/category/view', 'CategoryController@addCategoryView');

Route::post('category/product/insert', 'CategoryController@addCategoryInsert');

Route::get('change/menu/status/{category_id}', 'CategoryController@changeMenuStatus');




Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//FrontEnd 

Route::get('/', 'FrontendController@home');

Route::get('productdetails/view/{product_id}', 'FrontendController@productDetails');

Route::get('category/product/{category_id}', 'FrontendController@categoryWiseProduct');

Route::get('contact/view', 'FrontendController@contactView');

Route::post('contact/insert', 'FrontendController@contactInsert');

Route::get('add/to/cart/{product_id}', 'FrontendController@addToCart');

Route::get('cart', 'FrontendController@cart');

Route::get('delete/from/cart/{cart_id}', 'FrontendController@deleteFromCart');

Route::get('clear/cart', 'FrontendController@clearCart');


