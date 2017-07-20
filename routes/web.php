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
        /*Quản lý từ điển*/
        Route::group(['prefix' => 'dict','middleware'=>'AdminLogin'], function () {
        //  add word
            Route::GET('get', 'DictionaryManagementController@home')->name('getAddWord');
            Route::POST('add', 'DictionaryManagementController@getAddWord')->name('adminAdd');
        // Search word
            Route::GET('search','DictionaryManagementController@getSearch')->name('adminDisplay');
            Route::GET('search/result','DictionaryManagementController@search')->name('adminSearch');
        // Delete Word
            Route::post('delete', 'DictionaryManagementController@deleteWord'); 
        // Update từ
            Route::post('update', 'DictionaryManagementController@updateWord'); 
        // Upload file
            Route::GET('upload','DictionaryManagementController@upload')->name('adminUpload');
        });
        // Thông tin cá nhân
        Route::group(['prefix' => 'profile','middleware'=>'AdminLogin'], function () {
            Route::get('/', 'AdminController@getProfile')->name('adminProfile');

            Route::post('/', 'AdminController@updateProfile')->name('updateProfile');
        });
        /*Quản lý user*/
        Route::group(['prefix' => 'account','middleware'=>'AdminLogin'], function () {
        Route::get('get', 'UserManagementController@getAccount')->name('adminUserManagement');

        // Route::post('status', 'UserManagementController@changeStatus');

        // Route::post('role', 'UserManagementController@changeRole');

        // Route::post('delete', 'UserManagementController@deleteUser');

        // Route::get('detail/{id}', 'UserManagementController@getDetailUser')->name('adminGetDetailUser');
        // Route::post('updateDetail', 'UserManagementController@postDetailUser')->name('adminPostDetailUser');

        // Route::get('search', 'UserManagementController@searchUser')->name('adminSearchUser');
    });

    });
});
// END ADMIN


Route::get('testCrawler', 'AdminCrawlerController@testCrawler');
Route::get('testUploadWord', function () {
    return view('testUploadWord');
});
Route::post('testUploadWord', 'AdminCrawlerController@postUploadWords')->name('uploadWords');

