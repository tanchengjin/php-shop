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

//Route::get('/', 'IndexController@index');
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('products', 'ProductController@index')->name('products.index');
Route::get('products/{id}', 'ProductController@show')->name('products.show');

Route::group(['middleware'=>'auth'], function () {
    Route::post('carts/add', 'CartController@store')->name('carts.store');
    Route::get('carts/index','CartController@index')->name('carts.index');

    Route::post('orders','OrderController@store')->name('orders.store');

    Route::get('center/index','Center\IndexController@index')->name('center.index');

    Route::get('center/order/index','Center\OrderController@index')->name('center.order.index');
    Route::get('center/address/index','Center\AddressController@index')->name('center.address.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
