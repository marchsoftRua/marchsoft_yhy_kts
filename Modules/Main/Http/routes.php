<?php

Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers'], function()
{
    Route::get('/', 'MainController@index');
});
Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
    Route::get('/myadmin', 'AdminController@index');
});