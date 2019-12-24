<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('/test', 'HomeController@test');
    $router->resource('/article_category', ArticleCategoryController::class); 
    $router->resource('/setting', SettingController::class);
    $router->resource('/users', UserController::class);
    $router->resource('/score', UserScoreLogController::class);
<<<<<<< HEAD
    $router->resource('/article_list', ArticleListController::class);
    $router->resource('/wxorder', WxOrderController::class);
    
=======
    $router->resource('/article_list', ArticleListController::class); 
>>>>>>> 12049f1ad9f423618c768d3ac5c89324b0e46314

});
