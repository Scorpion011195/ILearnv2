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

Route::get('index', function(){
	return view('frontend/layouts/index');
});

/*=================ADMIN AREA==================*/
Route::get('/admin', function () {
	return view('admin.layouts.ilearn');
});

Route::get('admin/login', 'AdminController@getLogin')->name('adminGetLogin');
Route::post('admin/login', 'AdminController@postLogin')->name('adminPostLogin');

// END ADMIN

Auth::routes();
