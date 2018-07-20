<?php
namespace App\TheClass; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; 
class VideoFile extends BaseFile
{
	public function moveVideo($video_path,$img_path)//移动　并返回两个地址
	{
		// $this->setPathMod('public');
		$video_name = pathToFileName($video_path);
		$img_name = pathToFileName($img_path);
		$time_ = date("Y-m-d-h:i:s",time());
		$video_new_path = "/public/user/".Auth::id()."/video/".$time_."/".$video_name;
		$img_new_path = "/public/user/".Auth::id()."/video/".$time_."/".$img_name;
		Storage::move($video_path,$video_new_path);
		Storage::move($img_path,$img_new_path);
		return array($video_new_path,$img_new_path);
	}
}


