<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Class\ImageFile;
class Image extends Model
{
    // protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    // protected $fillable = [];

    public function getPath($request,$field = 'img')///返回路径
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
    // 	$path = $this->getPath($request);
    // 	$filename = explode('/', $path);
    // 	$newPath = '/public/user/'.Auth::id().'/'.end($filename);
    // 	if($path)
    // 	{
    // 		if(Storage::move($path,$newPath))
    // 			return $newPath;
    // 	}
    // }

    public function saveVideoImg($request,$field = 'img')//保存视频封面
    {
        $path = $this->getPath($request,$field);
        $filename = explode('/', $path);
        $filename = end($filename);
        $filetype = explode('.',$filename);

        $newPath = '/public/user/'.Auth::id().'/videoImg/'.$filename;
        Storage::move($path,$newPath);
        return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }
    public function saveUserImg($request,$field = 'img')//保存一个用户的头像　返回ｉｄ
    {
        $path = $this->getPath($request,$field);
        $filename = explode('/', $path);
        $filename = end($filename);
        $filetype = explode('.',$filename);

        $newPath = '/public/user/'.Auth::id().'/userImage.'.end($filetype);
        $userPath = substr(Auth::user()->head_url,7);
        if(Storage::disk('public')->exists($userPath));
            Storage::disk('public')->delete($userPath);
        Storage::move($path,$newPath);
        return $newPath;
        // return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }

    public function cacheImg($request,$field = 'img')//用户在选择封面时　所储存
    {
    	$path = $this->getPath($request,$field);
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
