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
Route::group(['middleware' =>'cors'], function () {

   	Route::get('author', 'Api\AuthorController@index');
	Route::get('geturl', 'Api\AuthorController@geturl');
	Route::get('getopenid', 'Api\AuthorController@getopenid');

});

#应用页面
Route::group(['middleware' =>['cors','apiAuth']], function () {
    Route::post('/index', 'Api\IndexController@index');
    Route::post('/getlist', 'Api\IndexController@getlist');
    Route::post('/changezan', 'Api\IndexController@changezan');
    Route::post('/wxconfig', 'Api\WechatController@config');
});