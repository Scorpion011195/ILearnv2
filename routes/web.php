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
//  return view('user/layouts/index');
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

Route::get('translate', 'TranslateController@getTranslateParagraph');
Route::get('translate-paragraph', ['as' => 'translateParagraph', 'uses' => 'TranslateController@translateParagraph']);

// Group link User After Login
Route::group(['middleware' => 'auth'], function () {

    // Go to page profile ò User 
    Route::get('profile', function(){
    return view('user/pages/profile');
    });

    // Go to edit profile
    Route::get('editprofile/{id}', ['as' => 'editprofile/{id}', 'uses' => 'UserController@getEditUser']);
    Route::post('editprofile/{id}', ['as' => 'editprofile/{id}', 'uses' => 'UserController@postEditUser']);

    // Go To User Change Pass
    Route::get('changePass', ['as' => 'changePass', 'uses' => 'UserController@getChangePass']);
    Route::post('changePass', ['as' => 'changePass', 'uses' => 'UserController@postChangePass']);

    // Go To My Word
    Route::get('history', 'WordUserController@getAddWordFromSearch');
    Route::post('myWord','WordUserController@addWordFromSearch');
    Route::post('addWordMyHistory', 'WordUserController@postAddWordUserFromMyHistory');
});

// Group link Notification
Route::group(['middleware' => 'auth'], function() {

    //Notification
    Route::post('notification', 'WordUserController@postUpdateNotification');
    Route::post('deleteWordHistory', 'WordUserController@postDeleteWordHistory');
    Route::post('addInfoNotificate', 'NotificationController@addInforOfNotification');
    Route::get('getIsOn', 'NotificationController@getIsOn' );
    Route::get('getIsStartNotification', 'NotificationController@getIsStartNotification');
    Route::get('endIsStartNotification', 'NotificationController@endIsStartNotification');
    Route::get('getTimeReminder', 'NotificationController@getTimeReminder');
    Route::get('getWordToPush', 'NotificationController@getWordToPush');
    Route::get('getTypeReminder', 'NotificationController@getTypeReminder');

});

/*=================ADMIN AREA==================*/
Route::group(['prefix' => 'admin'], function () {
    // Đăng nhập
    Route::get('login', 'AdminController@getLogin')->name('adminGetLogin');
    Route::post('/', 'AdminController@postLogin')->name('adminPostLogin');
    // Đăng xuất
    Route::get('logout', 'AdminController@logout')->name('adminLogout');
    // Trang chủ
    Route::group(['middleware' =>'AdminLogin'],function(){

        Route::get('/',function(){
            return view('admin.layouts.ilearn');
        });

        /*Quản lý từ điển*/
        Route::group(['prefix' => 'dict'], function () {
        //  add word
            Route::GET('get', 'DictionaryManagementController@home')->name('getAddWord');
            Route::POST('add', 'DictionaryManagementController@getAddWord')->name('adminAdd');
        // Search word
            Route::GET('search','DictionaryManagementController@getSearch')->name('adminDisplay');
            Route::POST('search','DictionaryManagementController@search')->name('adminSearch');
        // Delete Word
            Route::post('delete', 'DictionaryManagementController@deleteWord');
        // Update từ
            Route::post('update', 'DictionaryManagementController@updateWord');
        // Upload file
            Route::GET('upload','DictionaryManagementController@upload')->name('adminUpload');
            Route::POST('postUpload', 'AdminCrawlerController@postUploadWords')->name('adminPostUpload');
        // Collection
            Route::get('collect', 'StatisticManagementController@displayStatisticalResult')->name('adminDictCollect');
            Route::post('collect-added', 'StatisticManagementController@displayStatisticalResultByCondition')->name('adminDictCollectByCondition');
        });

        // Thông tin cá nhân
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'AdminController@getProfile')->name('adminProfile');

            Route::post('/', 'AdminController@updateProfile')->name('updateProfile');
        });

        /*Quản lý user*/
        Route::group(['prefix' => 'account'], function () {
        // Admin Seach user
            Route::get('get', 'UserManagementController@getAccount')->name('adminUserManagement');
            Route::get('search', 'UserManagementController@searchUser')->name('adminSearchUser');
        // Change Status
            Route::post('status', 'UserManagementController@changeStatus');
        // Chang role
            Route::post('role', 'UserManagementController@changeRole');
        // Delete user
            Route::post('deleteUser', 'UserManagementController@deleteUser');

            Route::get('detail/{id}', 'UserManagementController@detailUser')->name('adminGetDetailUser');
            // Route::post('updateDetail', 'UserManagementController@postDetailUser')->name('adminPostDetailUser');
        });
    });
});
// END ADMIN
