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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/moving-search', function () {
    return view('welcome');
});
Route::get('/api/postal/check-released', 'HomeController@postalCode')->name('postal-code');
Route::post('/api/locations/distance', 'HomeController@postalCodePost')->name('distance');
Route::get('/api/locations/distance', 'HomeController@distance');
Route::post('/v1/api/search/inventories', 'HomeController@inventoryPost')->name('inventory');
Route::get('/v1/api/search/inventories', 'HomeController@inventory');
Route::post('/v1/api/search/services', 'HomeController@servicesPost')->name('services');
Route::get('/v1/api/search/services', 'HomeController@services');
Route::post('/v1/api/search/services', 'HomeController@servicesPost')->name('services');
Route::get('/reserve/moving/price/', 'HomeController@price');
Route::post('/reserve/moving/price/', 'HomeController@pricePost');
Route::get('/v1/api/locationJson', 'HomeController@locationJson');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
