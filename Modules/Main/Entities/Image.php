<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    // protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    // protected $fillable = [];

    public function userUpload($request,$field = 'img')///用户上传图片，都将经过这个方法，游客不经过这个方法。
    {
    	if($request->hasFile($field))
    	{
    		$path = $request->img->store('public');
    		return $path;
    	}
    }
    /*
        保存一个图片存入数据库，返回自身
    */
    public function addImage($image_path,$user_id,$authority = 0)
    {
        $this->image_path = $image_path;
        $this->authority = $authority;
        $this->user_id = $user_id;
        $this->save();
        return $this;
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

    public function saveUserImg($request,$field = 'img')//保存一个用户的头像　返回ｉｄ
    {
        $path = $this->userUpload($request,$field);
        $filename = explode('/', $path);
        $filename = end($filename);
        $filetype = explode('.',$filename);
        $newPath = '/public/user/'.Auth::id().'/userImage.'.end($filetype);
        $userPath = substr(Auth::user()->head_url,7);
        // dd($userPath);
        if(Storage::disk('public')->exists($userPath));
            Storage::disk('public')->delete($userPath);
        Storage::move($path,$newPath);
        return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }

    public function cacheImg($request,$field = 'img')//用户在选择封面时　所储存
    {
    	$path = $this->userUpload($request,$field);
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
        return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }

}
