<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers'], function()
{
    Route::get('/AuthLogin', 'AuthController@postValidate');
    Route::get('/geetest','AuthController@getGeetest');
    Route::get('/login', 'MainController@login');
});
Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
    /****
    后台路由
    ******/
    Route::get('/admin', 'AdminController@index');
    Route::get('/sidenav','AdminController@navData');
    Route::get('/article', 'ArticleController@lookArticle');
    Route::get('/articlePage','AdminController@articlePage');

    Route::get('/articleList','ArticleController@showList');

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