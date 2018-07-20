<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use App\TheClass\VideoFile;

class Video extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
    protected $videoFile;

    public function __construct()
    {
        $this->videoFile = new VideoFile();
    }

    public function saveVideo($name,$description,$user_id,$imgId,$authority,$video_path)
    {
    	$this->name = $name;
    	$this->description = $description;
    	$this->user_id = $user_id;
    	$this->image_id = $imgId;
    	$this->authority = $authority;
    	$this->video_path = $video_path;
    	$this->save();
    	return $this;
    }

    public function cacheVideo($file)
    {
        $path = $this->videoFile->cacheFile($file);
        return $path;
    }

    public function downloadVideo($video_path,$img_path)
    {
        return $this->videoFile->moveVideo($video_path,$img_path);
    }

    /*移动缓存的视频和封面*/
    public function moveVideo($video_path,$img_path)
    {

    }

    /*
    通过视频路径生成一张视频首帧截图,返回地址
    */
    public function returnImg($path)
    {
        // /public\/cache\/fC4A9nHgv3EBdHSFh28WXiT1UsuvuKuBQYu8cbam.mp4
        // time ffmpeg -ss 00:02:06 -i test1.flv -f image2 -y test1.jpg
        $video_path = storage_path('app'.$path);
        $img_name = str_random(20).'.jpg';
        $img_path = storage_path('app/public/cache/'.$img_name);
        exec("time ffmpeg -ss 00:00:00 -i ".$video_path." -f image2 -y ".$img_path);
        return '/public/cache/'.$img_name;
    }

}
