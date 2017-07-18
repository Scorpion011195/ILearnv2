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

Route::get('index', function(){
	return view('frontend/layouts/index');
});

Route::get('home', function(){
    return view('frontend/pages/home');
});
Route::get('result', function(){
    return view('frontend/pages/result');
});
Route::get('login', function(){
    return view('frontend/pages/login');
});
Route::get('register', function(){
    return view('frontend/pages/register');
});
Route::get('translate', function(){
    return view('frontend/pages/translate_text');
});


/*=================ADMIN AREA==================*/
Route::group(['prefix' => 'admin'], function () {
    // Đăng nhập
    Route::get('login', 'AdminController@getLogin')->name('adminGetLogin');
    Route::post('login', 'AdminController@postLogin')->name('adminPostLogin');

    // Đăng xuất
    Route::get('logout', 'AdminController@logout')->name('adminLogout');

    // Trang chủ
    Route::group(['middleware' =>'AdminLogin'],function(){
   		Route::get('/',function(){
   			return view('admin.layouts.ilearn');
   		});
        Route::GET('get', 'DictionaryManagementController@return')->name('getAddWord');
        Route::POST('add', 'DictionaryManagementController@getAddWord')->name('adminAdd');
    });
    Route::GET('test','DictionaryManagementController@test');
});
// END ADMIN


Route::get('test', 'AdminCrawlerController@testCrawler');
