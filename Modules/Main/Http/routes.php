<?php

require 'addRoute.php';

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers'], function()
{
    Route::get('/AuthLogin', 'AuthController@postValidate');
    Route::get('/geetest','AuthController@getGeetest');

    Route::any('/login', 'MainController@login')->name('login');
    Route::post('/register','MainController@register');

    Route::get('/lauout','MainController@layout');
});
Route::group(['middleware' => ['web','auth'], 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
    /****
    后台路由
    ******/


    Route::get('/admin', 'AdminController@index');
    Route::get('/sidenav','AdminController@navData');
    Route::get('/article/{article_id?}', 'ArticleController@lookArticle');

    Route::get('/articlePage','AdminController@articlePage');
    Route::post('/getComment','ArticleController@getComments');
    Route::post('/getChild','ArticleController@getChildComments');
    Route::get('/articleList','ArticleController@showList');//nav获取页面

    Route::get('/articleList','ArticleController@showList');
    Route::get('/articlePage','AdminController@articlePage');//nav获取页面
    Route::get('/image/{user_id?}','ImageController@getUserImg');//用户获取头像

});

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Index'], function()
{
    /****
    前台路由
     ***/
    Route::get('/', 'IndexController@index');
    Route::post('/reader', 'IndexController@readerSetData');
    Route::post('/getHotUser', 'IndexController@getTheWeekHot');
    Route::post('/getSpeakRank', 'IndexController@getSpeakRank');
});

