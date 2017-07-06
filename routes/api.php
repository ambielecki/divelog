<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/calculator', 'DiveCalculatorController@postCalculator');
Route::post('/log_calculator', 'DiveCalculatorController@postLogCalculator');

Route::post('/image/list', 'ImageController@postImageList');
Route::post('/image/detail', 'ImageController@postImageDetail');

Route::post('/blog/href', 'BlogController@postCheckHref');
