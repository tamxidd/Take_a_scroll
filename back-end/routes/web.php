<?php

use App\Store;
use App\Category;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    // return view('welcome');
    return view('front-end.landing');
});


Auth::routes(['verify'=>true]);

//admin routes

Route::get('/create-category','CategoryController@create')->name('category.create');
Route::post('/create-category','CategoryController@store')->name('category.store');
Route::get('/categories/{category}/subcategory/create','SubCategoryController@create')->name('subcategory.create');
Route::post('/categories/{category}/subcategory/create','SubCategoryController@store')->name('subcategory.store');


Route::middleware(['verified','vendor'])->group( function () {
    Route::get('/vendor-dashboard', 'HomeController@index')->name('dashboard');

    //sore-routes
    Route::resource('stores', StoreController::class)->except('stores.update');

    Route::post('/stores/{store}','StoreController@update')->name('stores.update');


    // electronics pruducts
    Route::get('stores/{store}/product/create','ProductController@create')->name('product.create');
    Route::post('/stores/{store}/products','ProductController@store')->name('product.store');
    Route::post('/stores/{store}/products/cars','ProductController@store_cars')->name('product.store.cars');

    Route::get('stores/{store}/products','ProductController@index')->name('products.view');
    Route::delete('products/{product}','ProductController@destroy')->name('product.delete');
    Route::get('/products/{product}/edit','ProductController@edit')->name('product.edit');
    Route::post('/products/{product}/update','ProductController@update')->name('product.update');
    Route::post('/product-image','ProductController@store_product_image')->name('prodevt.image_upload');

    // car products
    Route::get('stores/{store}/product/create-car','ProductController@car_create')->name('cars.product.create');

});

// customer routes
Route::middleware(['verified','customer'])->group( function () {
    Route::get('/customer-dashboard','CustomerProfileController@index')->name('customer.dashboard');
    //cart
    Route::get('/cart','CartController@index')->name('cart.index');
    Route::get('/cart/products/{product}/add','CartController@add_to_cart')->name('cart.add');
    Route::get('/cart/remove/product/{id}','CartController@remove_item')->name('cart.remove');
    Route::get('/cart-restore','CartController@restore');

});


// store routes for customer
Route::get('/stores/{store}/view','StoreController@show_customer')->name('customer.shop.show');



Route::get('/chat', 'HomeController@chat')->name('chat');
Route::get('/fetch-contacts','ChatController@contacts')->name('chat.contacts');
Route::get('/messages/{id}','ChatController@fetchMessages')->name('chat.messages');
Route::post('/message/send','ChatController@storeMessage')->name('chat.storemessage');

// category
Route::get('/categories','CategoryController@index')->name('product.categories');
Route::get('/categories/cars','CategoryController@cars')->name('product.categories.car');

Route::get('/sub-category/{name}','CategoryController@fetch_sub_category')->name('product.sub-categories');

Route::get('/test/{id}','ProductController@index');




//sub actegory or products


Route::get('categories/{category}/{sub_cat_name}/{sub_cat}','SubCategoryController@index')->name('category.products.index');
Route::get('categories/{category}/{sub_cat_name}/{sub_cat}/products/{product}','SubCategoryController@show')->name('category.products.show');


Route::get('/logout', function () {
    //logout user
    Auth::logout();
    // redirect to homepage
    return redirect('/');
});



View::composer(['*'], function ($view) {

    $categories=Category::all();
    $cart=Cart::count();
    $electronics_shops=Store::where('type','electronics')->get();
    $realestate_shops=Store::where('type','realestate')->get();
    $cars_shops=Store::where('type','cars')->get();
    // $shops=array(['Electronics'=>$electronics_shops,'Realestate'=>$realestate_shops,'Cars'=>$cars_shops]);
// dd($shops);
    $view->with(['categories'=>$categories,'cart'=>$cart,'Electronics'=>$electronics_shops,'Realestate'=>$realestate_shops,'Cars'=>$cars_shops]);
});
