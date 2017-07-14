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
/*=================USER AREA==================*/
Route::get('/', function () {
	return view('welcome');
});

Route::get('login', [ 'as' => 'login', 'uses' => 'UserController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'UserController@postLogin']);

Route::get('register', [ 'as' => 'register', 'uses' => 'UserController@getRegister']);
Route::post('register', [ 'as' => 'register', 'uses' => 'UserController@postRegister']);
Route::get('logout', ['as'=>'logout', 'uses' => 'UserController@logout']);

Route::get('user/pages/verifyEmail/{confirmationCode}','UserController@confirm'
)->name('confirm');

Route::get('index', function(){
	return view('user/layouts/index');
});

Route::get('home', function(){
    return view('user/pages/home');
});

Route::get('result', function(){
    return view('user/pages/result');
});
Route::get('translate', function(){
    return view('user/pages/translate_text');
});


/*=================ADMIN AREA==================*/
Route::get('/admin', function () {
	return view('admin.layouts.ilearn');
});

Route::get('admin/login', 'AdminController@getLogin')->name('adminGetLogin');
Route::post('admin/login', 'AdminController@postLogin')->name('adminPostLogin');

// END ADMIN
Route::get('test', 'AdminCrawlerController@testCrawler');
