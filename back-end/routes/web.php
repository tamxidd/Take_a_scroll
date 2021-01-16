<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});


Auth::routes(['verify'=>true]);
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/chat', 'HomeController@chat')->name('chat');
Route::get('/fetch-contacts','ChatController@contacts')->name('chat.contacts');
Route::get('/messages/{id}','ChatController@fetchMessages')->name('chat.messages');
Route::post('/message/send','ChatController@storeMessage')->name('chat.storemessage');
// pruducts
Route::get('/create-product','ProductController@create')->name('product.create');
Route::post('/create-product','ProductController@store')->name('product.create');
Route::get('/products','ProductController@index')->name('products.view');
Route::delete('products/{product}','ProductController@destroy')->name('product.delete');
Route::get('/products/{product}/edit','ProductController@edit')->name('product.edit');
Route::post('/products/{product}/update','ProductController@update')->name('product.update');

Route::post('/product-image','ProductController@store_product_image')->name('prodevt.image_upload');
// category
Route::get('/categories','CategoryController@index')->name('product.categories');
Route::get('/sub-category/{name}','CategoryController@fetch_sub_category')->name('product.sub-categories');

Route::get('/test/{id}','ProductController@index');




Route::get('/logout', function () {
    //logout user
    Auth::logout();
    // redirect to homepage
    return redirect('/');
});
