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
    Route::get('/userInfo','AdminController@userInfoShow');
    Route::any('/changeImage','AdminController@changeImage');//更改用户头像

    /*
        放到nav的地址
    */
    Route::get('/articlePage','AdminController@articlePage');
    Route::get('/lable','LableController@index');
    Route::get('/type','TypeController@index');

    Route::get('/articleList','ArticleController@showList');//nav获取页面
    Route::get('/typeList','TypeController@showList');

    Route::get('/image/{user_id?}','ImageController@getUserImg');//用户获取头像

});

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Index'], function()
{
    /****
    前台路由
     ***/
    Route::get('/article/{article_id?}', 'ArticleShowController@lookArticle');
    Route::post('/getComment','ArticleShowController@getComments');
    Route::post('/jie/sendComment','ArticleShowController@sendComments');
    Route::post('/getChild','ArticleShowController@getChildComments');
    Route::get('/', 'IndexController@index');
    Route::post('/reader', 'IndexController@readerSetData');
    Route::post('/getHotUser', 'IndexController@getTheWeekHot');
    Route::post('/getSpeakRank', 'IndexController@getSpeakRank');
    Route::get('/404',"IndexController@error_page");
});

