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

Route::get('/', 'HomeController@getHome')->name('home');

Route::get('/updates', 'PageController@getUpdates')->name('updates');

Auth::routes();

//logged in users

Route::group(['middleware' => 'auth'], function () {
    Route::get('/settings', 'UserController@getSettings')->name('user_settings');
    Route::post('/settings', 'UserController@postSettings');
});

//admin routes
Route::group(['middleware' => 'isadmin', 'prefix' => '/admin'], function () {
    Route::get('/info', function () {
        phpinfo();
    });
    Route::get('/', 'AdminController@getAdmin')->name('admin');

    Route::get('/home/edit', 'HomeController@getEditHome')->name('home_edit');
    Route::post('/home/edit', 'HomeController@postEditHome');

    Route::group(['prefix' => '/image'], function () {
        Route::get('/list', 'ImageController@getImageList')->name('image_list');
        Route::get('/upload', 'ImageController@getUploadImage')->name('image_upload');
        Route::post('/upload', 'ImageController@postUploadImage');
        Route::get('/edit/{id}', 'ImageController@getEdit')->name('image_edit');
        Route::post('/edit', 'ImageController@postEdit');
    });

    Route::group(['prefix' => '/image_folder'], function () {
        Route::get('/list', 'ImageController@getFolderList')->name('image_folder_list');
        Route::get('/create', 'ImageController@getFolderCreate')->name('image_folder_create');
        Route::post('/create', 'ImageController@postFolderCreate');
    });

    Route::group(['prefix' => '/blog'], function () {
        Route::get('/list/{page?}', 'BlogController@getAdminList')->name('blog_admin_list');
        Route::get('/create', 'BlogController@getCreate')->name('blog_create');
        Route::post('/create', 'BlogController@postCreate');
        Route::get('/edit/{href}', 'BlogController@getEdit')->name('blog_edit');
        Route::post('/edit/{href}', 'BlogController@postEdit');
        Route::post('/disable/{href}', 'BlogController@postDisable')->name('blog_disable');
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/list', 'UserController@getList')->name('user_list');
        Route::get('/edit/{id}', 'UserController@getEdit')->name('user_edit');
    });

    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});

Route::group(['prefix' => '/divelog'], function () {
    Route::get('/list/{page?}', 'DiveLogController@getList')->name('divelog_list');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/create', 'DiveLogController@getCreate')->name('divelog_create');
        Route::post('/create', 'DiveLogController@postCreate');

        Route::get('/edit/{id}', 'DiveLogController@getEdit')->name('divelog_edit');
        Route::post('/edit/{id}', 'DiveLogController@postEdit');

        Route::get('/pdf/{id}', 'DiveLogController@getPdf')->name('divelog_pdf');
    });
});

Route::group(['prefix' => '/updates'], function () {
    Route::get('/list', 'BlogController@getList')->name('updates_list');
    Route::get('/view/{slug}', 'BlogController@getView')->name('updates_view');
});

Route::get('/calculator', 'DiveCalculatorController@getCalculator')->name('calculator');

Route::get('/test2', 'TestController@getTest2');

//image routes
Route::get('/images/{folder}/{file}', 'ImageController@getImage');
Route::get('/fullimage/{folder}/{file}', 'ImageController@getFullImage');
