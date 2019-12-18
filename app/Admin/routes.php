<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('/article_category', ArticleCategoryController::class); 
    $router->resource('/setting', SettingController::class);
    $router->resource('/users', UserController::class);
    $router->resource('/score', UserScoreLogController::class);
    $router->resource('/article_list', ArticleListController::class);
});
