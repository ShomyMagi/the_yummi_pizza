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

Route::group(array('https'), function()
{
    Route::get('/', 'ProductController@index');
    Route::get('/products', 'ProductController@getProducts');
    Route::get('/cart', 'CartController@index');
    Route::get('/cart/getCart', 'CartController@getCart');
    Route::post('/addToCart/{id}', 'CartController@addToCart');
    Route::get('/deleteCart/{id}', 'CartController@deleteFromCart');
    Route::get('/cart/countCart', 'CartController@countCart');
    Route::post('/order', 'OrderController@order');
    Route::get('/cart/delete', 'CartController@deleteCart');
});
