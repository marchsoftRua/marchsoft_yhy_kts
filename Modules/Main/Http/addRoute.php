<?php 


Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
	Route::any('/add/article','ArticleController@index');//文章上传页
	Route::any('/add/image','ImageController@index');
	Route::any('/add/type','TypeController@addType');
	Route::any('/add/video','VideoController@index');//视频上传页;
	Route::post('/add/link/video','VideoController@linkUpload');//视频上传接口
	Route::post('/upload/video','VideoController@uploadVideo');//真实视频上传
});