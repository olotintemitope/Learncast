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

/*
 * This route belongs to dashboard
 */
Route::group(['prefix' => '/dashboard', 'middleware' => ['web', 'auth']], function () {

    Route::get('/', 'CategoryController@index');

    Route::get('/logout', 'Auth\AuthController@logUserOut');

    Route::get('/profile', function () {
        return view('dashboard.pages.view_myprofile');
    });

    Route::get('/video/add', [
        'uses' => 'VideoController@index',
    ]);

    Route::post('/video/create', [
        'uses' => 'VideoController@store',
    ]);

    Route::get('/video/view', [
        'uses' => 'VideoController@viewAllVideos',
    ]);

    Route::get('/video/edit/{id}', [
        'uses' => 'VideoController@getVideo',
    ]);

    Route::post('/video/update/{id}', [
        'uses' => 'VideoController@updateVideo',
    ]);

    Route::get('/video/delete/{id}', [
        'uses' => 'VideoController@changeVideoStatus',
    ]);

    Route::post('/profile/update', [
        'uses' => 'UserController@updateProfile',
    ]);

    Route::post('/picture/update', [
        'uses' => 'UserController@updateAvatar',
    ]);

    Route::get('/video/favourites', [
        'uses' => 'VideoController@myFavouriteVideos',
    ]);

});

/*
|----------------------------------------------------------
| Video category is protected by this middle. It checks for the
| user role and redirect non admin user when they try to manipulate pages
| via the page url
 */
Route::group(['prefix' => '/dashboard', 'middleware' => ['web', 'auth', 'auth.notadmin']], function () {
    Route::get('/category/add', function () {
        return view('dashboard.pages.video_category');
    });

    Route::get('/category/view', [
        'uses' => 'CategoryController@viewAllCategories',
    ]);

    Route::post('/category/create', [
        'uses' => 'CategoryController@store',
    ]);

    Route::get('/category/edit/{id}', [
        'uses' => 'CategoryController@getCategory',
    ]);

    Route::post('/category/update/{id}', [
        'uses' => 'CategoryController@updateCategory',
    ]);

    Route::get('/category/delete/{id}', [
        'uses' => 'CategoryController@changeCategoryStatus',
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
    Route::post('/register', 'Auth\AuthController@postRegister');
    Route::post('/login', 'Auth\AuthController@loginUser');
});

/*
 * Social login routes
 */
Route::group(['prefix' => '/auth/{provider}', 'middleware' => ['web']], function () {
    Route::get('/', 'Auth\AuthController@redirectToProvider');
    Route::get('/callback', 'Auth\AuthController@handleProviderCallback');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'HomePageController@index');
    Route::get('/search', 'HomePageController@search');
    Route::get('/view/video/{video_id}', 'HomePageController@viewCurrentVideo');
    Route::get('/favourite/video/{video_id}', 'HomePageController@favouriteVideo');
    Route::get('/load/video/comments', 'HomePageController@loadMoreComments');
    Route::auth();
    Route::get('/login', function () {
        return view('main.pages.auth.userlogin_form');
    });
});

/* This route belongs to a group of video  */
Route::group(['prefix' => '/video', 'middleware' => ['web']], function () {
    Route::get('/category/{name}', 'VideoController@getVideosByCategory');
    Route::post('/comment/add', 'CommentController@addComment');
    Route::get('/comment/delete/{id}', 'CommentController@softDeleteComment');
    Route::get('/comment/update/{id}', 'CommentController@updateComment');
});
