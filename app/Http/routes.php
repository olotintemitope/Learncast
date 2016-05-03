<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/welcome', function () {
    return view('main.pages.single_video');
});

Route::group(['prefix' => '/dashboard','middleware' => ['web','auth']], function () {

    Route::auth();

    Route::get('/', function () {
        return view('dashboard.index');
    });

    Route::get('/logout', 'Auth\AuthController@logUserOut');

    Route::get('/category/add', function () {
        return view('dashboard.pages.video_category');
    });

    Route::get('/category/view',  [
        'uses' => 'CategoryController@viewAllCategories', 
    ]);

    Route::get('/profile', function () {
        return view('dashboard.pages.view_myprofile');
    });

    Route::post('/category/create', [
        'uses' => 'CategoryController@store', 
    ]);

    Route::get('/category/edit/{id}',  [
        'uses' => 'CategoryController@getCategory', 
    ]);

    Route::post('/category/update/{id}',  [
        'uses' => 'CategoryController@updateCategory', 
    ]);

    Route::get('/category/delete/{id}',  [
        'uses' => 'CategoryController@changeCategoryStatus', 
    ]);

    Route::get('/video/add', [
        'uses' => 'VideoController@index', 
    ]);

    Route::post('/video/create', [
        'uses' => 'VideoController@store', 
    ]);

    Route::get('/video/view', [
        'uses' => 'VideoController@viewAllVideos', 
    ]);

    Route::get('/video/edit/{id}',  [
        'uses' => 'VideoController@getVideo', 
    ]);

    Route::post('/video/update/{id}',  [
        'uses' => 'VideoController@updateVideo', 
    ]);

    Route::get('/video/delete/{id}',  [
        'uses' => 'VideoController@changeVideoStatus', 
    ]);

    Route::post('/profile/update',  [
        'uses' => 'UserController@updateProfile', 
    ]);

    Route::post('/picture/update',  [
        'uses' => 'UserController@updateAvatar', 
    ]);

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => '/auth', 'middleware' => ['web']], function () {
    Route::get('/github', 'Auth\AuthController@redirectToProvider');
    Route::get('/github/callback', 'Auth\AuthController@handleProviderCallback');
    Route::post('/register', 'Auth\AuthController@postRegister');
    Route::post('/login', 'Auth\AuthController@loginUser');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', function () {
        return view('main.pages.auth.userlogin_form');
    });
});
