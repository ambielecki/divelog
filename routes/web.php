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

Route::group(['middleware' => 'isadmin', 'prefix' => 'admin'], function() {
    Route::get('/', 'AdminController@getAdmin')->name('admin');

    Route::get('/home/edit', 'HomeController@getEditHome')->name('home_edit');
    Route::post('/home/edit', 'HomeController@postEditHome');

    Route::get('/image/list', 'ImageController@getImageList')->name('image_list');
    Route::get('/image/upload', 'ImageController@getUploadImage')->name('image_upload');
    Route::post('/image/upload', 'ImageController@postUploadImage');

    Route::get('image_folder/list', 'ImageController@getFolderList')->name('image_folder_list');
    Route::get('image_folder/create', 'ImageController@getFolderCreate')->name('image_folder_create');
    Route::post('image_folder/create', 'ImageController@postFolderCreate');

    Route::get('page/list', 'PageController@getList')->name('page_list');
    Route::get('page/create', 'PageController@getCreate')->name('page_create');
    Route::post('page/create', 'PageController@postCreate');
});

Route::get('/divelog', 'DiveLogController@getDiveLog')->name('divelog');

Route::get('/calculator', 'DiveCalculatorController@getCalculator')->name('calculator');

Route::get('/logs','\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/test2', 'TestController@getTest2');

//image routes
Route::get('/images/{folder}/{file}','ImageController@getImage');
Route::get('/fullimage/{folder}/{file}','ImageController@getFullImage');
