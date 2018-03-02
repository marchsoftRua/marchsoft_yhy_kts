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
    Route::any('/userInfo','AdminController@userInfoShow');//改成ａｎｙ　修改的信息也提交到这个路由
    Route::any('/changeImage','AdminController@changeImage');//更改用户头像
    Route::any('/changepwd','AdminController@changepwd');//修改用户密码
    Route::any('/change/article/{article_id}','AdminController@changeArticle');//修改页面　和数据提交本页
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
    Route::get('/user_home/{user_playname?}', 'IndexController@showPerson_home');
    
    Route::get('/', 'IndexController@index');
    Route::post('/reader', 'IndexController@readerSetData');
    Route::post('/comment_delete','ArticleShowController@comment_delete');
    Route::post('/getHotUser', 'IndexController@getTheWeekHot');
    Route::post('/getSpeakRank', 'IndexController@getSpeakRank');
    Route::get('/404',"IndexController@error_page");
});

