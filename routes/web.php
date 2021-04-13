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


Auth::routes();


Route::get('/', 'App\Http\Controllers\AdminController@index')->name('all');

Route::any('/add-customer', 'App\Http\Controllers\CustomerController@index')->name('add-customer');

Route::post('/add-customer', 'App\Http\Controllers\CustomerController@create')->name('create-customer');

Route::get('/get-customer/{id}', 'App\Http\Controllers\CustomerController@getCustomer')->name('get-customer');

Route::post('/add-details', 'App\Http\Controllers\CustomerController@addDetails')->name('add-details');

Route::get('/get-detail/{id}', 'App\Http\Controllers\CustomerController@getDetail')->name('get-detail');

Route::post('/add-invoices', 'App\Http\Controllers\CustomerController@addInvoices')->name('add-invoices');

Route::get('/get-invoice/{id}', 'App\Http\Controllers\CustomerController@getInvoice')->name('get-invoice');
