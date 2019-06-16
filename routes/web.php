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

Route::get('/', 'IndexController@index');
Route::get('/weather', 'IndexController@getWeather')->name('weather');
Route::get('/orders', 'OrdersController@index')->name('ordersList');
Route::get('/order/{id}', 'OrdersController@getOrderPage');
Route::get('/newOrdersList', 'OrdersController@indexNewOrdersList')->name('newOrdersList');

Route::post('/saveOrder', 'OrdersController@saveOrder')->name('saveOrder');
Route::get('/products', 'ProductsController@index')->name('products');
Route::post('/changePrice', 'ProductsController@changePrice');