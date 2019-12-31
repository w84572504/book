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
	#首页
    Route::post('/index', 'Api\IndexController@index');
    #获取列表
    Route::post('/getlist', 'Api\IndexController@getlist');
    #点赞
    Route::post('/changezan', 'Api\IndexController@changezan');
    #付费获取文章
    Route::post('/getmore', 'Api\IndexController@getmore');
    #用户信息
    Route::post('/uinfo', 'Api\IndexController@uinfo');
    #微信分享配置
    Route::post('/wxconfig', 'Api\WechatController@config');
    #分享图片
    Route::post('/shareimg', 'Api\WechatController@shareimg');
});