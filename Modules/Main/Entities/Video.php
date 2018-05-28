<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];

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

    public function downloadVideo($request)
    {

    }
}
