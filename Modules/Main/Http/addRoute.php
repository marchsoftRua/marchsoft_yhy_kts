<?php 


Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
	Route::any('/add/article','ArticleController@index');//文章上传页
	Route::any('/add/image','ImageController@index');
	Route::any('/add/type','TypeController@addType');
});