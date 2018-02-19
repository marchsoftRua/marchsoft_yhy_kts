<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    // protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    // protected $fillable = [];

    public function userUpload($request)///用户上传图片，都将经过这个方法，游客不经过这个方法。
    {
    	if($request->hasFile('img'))
    	{
    		$path = $request->img->store('public');
    		return $path;
    	}
    }
    // public function saveArticleImg($path)
    // {
    // 	$path = $this->userUpload($request);
    // 	$filename = explode('/', $path);
    // 	$newPath = '/public/user/'.Auth::id().'/'.end($filename);
    // 	if($path)
    // 	{
    // 		if(Storage::move($path,$newPath))
    // 			return $newPath;
    // 	}
    // }
    public function cacheImg($request)//用户在选择封面时　所储存
    {
    	$path = $this->userUpload($request);
    	$filename = explode('/', $path);
    	$newPath = '/public/user/'.Auth::id().'/cache/'.end($filename);
    	if($path)
    	{
			if(Storage::move($path,$newPath))
				return $newPath;
    	}
    }

    public function saveArticleImg($path)
    {
    	$filename = explode('/', $path);
    	$newPath = '/public/user/'.Auth::id().'/'.end($filename);
    	Storage::move($path,$newPath);
    	$this->user_id = Auth::id();
    	$this->image_path = $newPath;
    	$this->authority = Auth::user()->user_type;
    	$this->save();
    	return $this->id;
    }

}
