<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\TheClass\ImageFile;
class Image extends Model
{
    // protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    // protected $fillable = [];
    protected $imageFile;//图片文件操作对象
    public function __construct()
    {
        $this->imageFile = new ImageFile();
    }

    public function getPath($file)///缓存并返回缓存路径
    {
        return $this->imageFile->cacheFile($request->file($file));

    	// if($request->hasFile($field))
    	// {
    	// 	$path = $request->img->store('public');
    	// 	return $path;
    	// }
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

    public function saveVideoImg($path)//保存视频封面
    {
        return $this->imageFile->saveVideoImg($path);


        // $path = $this->getPath($request,$field);
        // $filename = explode('/', $path);
        // $filename = end($filename);
        // $filetype = explode('.',$filename);

        // $newPath = '/public/user/'.Auth::id().'/videoImg/'.$filename;
        // Storage::move($path,$newPath);
        // return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }
    public function saveUserImg($path)//保存一个用户的头像　返回ｉｄ
    {
        return $this->imageFile->saveUserImg($path);


        // $path = $this->getPath($request,$field);
        // $filename = explode('/', $path);
        // $filename = end($filename);
        // $filetype = explode('.',$filename);

        // $newPath = '/public/user/'.Auth::id().'/userImage.'.end($filetype);
        // $userPath = substr(Auth::user()->head_url,7);
        // if(Storage::disk('public')->exists($userPath));
        //     Storage::disk('public')->delete($userPath);
        // Storage::move($path,$newPath);
        // return $newPath;

        // return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }

    public function cacheImg($file)//用户在选择封面时　所储存
    {
        
        return $this->imageFile->cacheFile($file);

   //  	$path = $this->getPath($request,$field);
   //  	$filename = explode('/', $path);
   //  	$newPath = '/public/user/'.Auth::id().'/cache/'.end($filename);
   //  	if($path)
   //  	{
			// if(Storage::move($path,$newPath))
			// 	return $newPath;
   //  	}
    }

    public function saveArticleImg($path)
    {
        return $this->imageFile->saveArticleImg($path);

    	// $filename = explode('/', $path);
    	// $newPath = '/public/user/'.Auth::id().'/'.end($filename);
    	// Storage::move($path,$newPath);
     //    return $this->addImage($newPath,Auth::id(),Auth::user()->user_type)->id;
    }

}
