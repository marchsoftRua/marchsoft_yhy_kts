<?php 


Route::group(['middleware' => 'web', 'namespace' => 'Modules\Main\Http\Controllers\Admin'], function()
{
	Route::any('/add/article','ArticleController@index');//文章上传页
	Route::any('/add/image','ImageController@index');//缓存并返回地址
	Route::any('/add/type','TypeController@addType');//文章类型
	Route::any('/add/video','VideoController@index');//视频上传页;
	Route::post('/add/link/video','VideoController@linkUpload');//视频上传接口
	Route::post('/cache/video','VideoController@cacheVideo');//缓存视频上传
	Route::any('/upload/video','VideoController@uploadVideo');//提交视频上传表单
});