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

// Route::get('index', function(){
// 	return view('user/layouts/index');
// });

// Link for User search Word
Route::get('home', ['as' => 'home', 'uses' => 'DictionaryController@getSearchDictionary']);
Route::get('search', ['as' => 'search', 'uses' => 'DictionaryController@postSearchDictionary']);

Route::get('notify', function(){
    return view('user/pages/notify');
});
Route::get('result', function(){
    return view('user/pages/result');
});
Route::get('history', function(){
    return view('user/pages/history');
});

Route::get('translate', 'TranslateController@getTranslateParagraph');

Route::get('translate-paragraph', ['as' => 'translateParagraph', 'uses' => 'TranslateController@translateParagraph']);

// Route::get('profile', ['as' => 'profile', 'uses'=>'UserController@getShowUser']);
Route::get('profile', function(){
    return view('user/pages/profile');
})->middleware('auth');

Route::get('editprofile/{id}', ['as' => 'editprofile/{id}', 'uses' => 'UserController@getEditUser'])->middleware('auth');
Route::post('editprofile/{id}', ['as' => 'editprofile/{id}', 'uses' => 'UserController@postEditUser'])->middleware('auth');
//User change password
Route::get('changePass', ['as' => 'changePass', 'uses' => 'UserController@getChangePass'])->middleware('auth');
Route::post('changePass', ['as' => 'changePass', 'uses' => 'UserController@postChangePass'])->middleware('auth');


/*=================ADMIN AREA==================*/
Route::get('/admin', function () {
	return view('admin.layouts.ilearn');
});

Route::get('admin/login', 'AdminController@getLogin')->name('adminGetLogin');
Route::post('admin/login', 'AdminController@postLogin')->name('adminPostLogin');

// END ADMIN


Route::get('testCrawler', 'AdminCrawlerController@testCrawler');
Route::get('testUploadWord', function () {
    return view('testUploadWord');
});
Route::post('testUploadWord', 'AdminCrawlerController@postUploadWords')->name('uploadWords');

