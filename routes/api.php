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
#登录 
Route::get('author', 'Api\AuthorController@index');  

#应用页面
Route::group(['middleware' =>'apiAuth'], function () {

    Route::post('/index', 'Api\IndexController@index');
});