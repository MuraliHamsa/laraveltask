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

Route::get('/', 'ServiceRequestsController@index')->name('home');
Route::get('/deleteticket', 'ServiceRequestsController@deleteticket');
Route::get('{id}', 'ServiceRequestsController@edit')->name('edit');

Route::post('/store','ServiceRequestsController@store');

Route::get('/home', 'HomeController@index')->name('home');
Route::POST('/getmodels','HomeController@getmodels');
// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
