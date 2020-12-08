<?php

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





Route::get('/contact', 'PagesController@contact')->name('contact');

Route::get('/products', 'PagesController@products')->name('products');

Route::get('/about', 'PagesController@about')->name('about');

Route::get('/', 'PagesController@front')->name('front');


Route::get('/price1', 'PagesController@price1')->name('price1');
Route::get('/price2', 'PagesController@price2')->name('price2');

//Shopname
Route::get('/shop1', 'ShopController@shop1')->name('shop1');
Route::get('/shop2', 'ShopController@shop2')->name('shop2');
Route::get('/shop3', 'ShopController@shop3')->name('shop3');



//Category Division
Route::get('/art', 'PagesController@art')->name('art');
Route::get('/art1', 'PagesController@art1')->name('art1');
Route::get('/art2', 'PagesController@art2')->name('art2');

Route::get('/cloth', 'PagesController@cloth')->name('cloth');
Route::get('/cloth1', 'PagesController@cloth1')->name('cloth1');
Route::get('/cloth2', 'PagesController@cloth2')->name('cloth2');

Route::get('/food', 'PagesController@food')->name('food');
Route::get('/food1', 'PagesController@food1')->name('food1');
Route::get('/food2', 'PagesController@food2')->name('food2');

Route::get('/gift', 'PagesController@gift')->name('gift');
Route::get('/gift1', 'PagesController@gift1')->name('gift1');
Route::get('/gift2', 'PagesController@gift2')->name('gift2');

Route::get('/living', 'PagesController@living')->name('living');
Route::get('/living1', 'PagesController@living1')->name('living1');
Route::get('/living2', 'PagesController@living2')->name('living2');


Route::get('/item','ProductController@index')->name('item');
Route::get('/item/{slug}','ProductController@show')->name('item.show');

Route::get('/search','PagesController@search')->name('search');


//Admin routes
Route::group(['prefix' => 'admin'], function(){
Route::get('/', 'AdminPagesController@index')->name('admin.index');
});

//Product routes
Route::group(['prefix' => '/product'], function(){

Route::get('/', 'AdminProductController@index')->name('admin.products');
Route::get('/create', 'AdminProductController@create')->name('admin.product.create');
Route::get('/edit/{id}', 'AdminProductController@edit')->name('admin.product.edit');

Route::post('/store', 'AdminProductController@product_store')->name('admin.product.store');

Route::post('/edit/{id}', 'AdminProductController@product_update')->name('admin.product.update');
Route::get('/delete/{id}','AdminProductController@product_delete')->name('admin.product.delete');
});


//Category Routes
Route::group(['prefix' => '/Category'], function(){

Route::get('/', 'CategoryController@index')->name('admin.categories'); 
Route::get('/create', 'CategoryController@create')->name('admin.category.create');
Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.category.edit');

Route::post('/store', 'CategoryController@store')->name('admin.category.store');


Route::post('/edit/{id}', 'CategoryController@update')->name('admin.category.update');
Route::get('/delete/{id}','CategoryController@delete')->name('admin.category.delete');


});


//Order Routes
Route::group(['prefix' => '/Order'], function(){

Route::get('/', 'OrderController@index')->name('admin.orders');
Route::get('/view/{id}', 'OrderController@view')->name('admin.orders.view');
Route::get('/delete/{id}','OrderController@delete')->name('admin.orders.delete');


});

//Coupon
Route::group(['prefix' => '/Coupon'], function(){

Route::get('/', 'CouponController@index')->name('admin.coupons'); 
Route::get('/create', 'CouponController@create')->name('admin.coupon.create');
Route::get('/edit/{id}', 'CouponController@edit')->name('admin.coupon.edit');

Route::post('/store', 'CouponController@store')->name('admin.coupon.store');


Route::post('/edit/{id}', 'CouponController@update')->name('admin.coupon.update');
Route::get('/delete/{id}','CouponController@delete')->name('admin.coupon.delete');


});


//Cart
Route::post('/addcart/{product_id}/{stock}','CartController@addToCart');
Route::get('cart','CartController@cartpage');
Route::get('cart/remove/{cart_id}','CartController@remove');
Route::post('cart/update/{cart_id}','CartController@quantityupdate');
Route::post('coupon/apply','CartController@applyCoupon');
Route::get('coupon/remove','CartController@removeCoupon');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// SSLCOMMERZ Start
Route::get('/payment', 'SslCommerzPaymentController@exampleEasyCheckout');
Route::get('/example2', 'SslCommerzPaymentController@exampleHostedCheckout');

Route::post('/pay', 'SslCommerzPaymentController@index');
Route::post('/pay-via-ajax', 'SslCommerzPaymentController@payViaAjax');

Route::post('/success', 'SslCommerzPaymentController@success');
Route::post('/fail', 'SslCommerzPaymentController@fail');
Route::post('/cancel', 'SslCommerzPaymentController@cancel');

Route::post('/ipn', 'SslCommerzPaymentController@ipn');
//SSLCOMMERZ END
