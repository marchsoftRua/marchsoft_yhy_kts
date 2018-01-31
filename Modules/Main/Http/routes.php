<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers'], function()
{
    Route::get('/login', 'MainController@login');
    Route::get('/','MainController@index');
});
Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
    Route::get('/myadmin', 'AdminController@index');
    Route::get('/sidenav','AdminController@navData');
});