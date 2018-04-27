<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Video;
use Modules\Main\Entities\Image;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    var $videoModel = null;
    public $imageModel = null;
    public function __construct()
    {
        $this->videoModel = new Video();
        $this->imageModel = new Image();
    }   

    public function index(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('main::admin.page.video.addvideo');
        }
        else
            return ("烦烦烦");
    }

    /*
    通过链接上传
    */
    public function linkUpload(Request $request)
    {
        $name = $request->name;
        $description = $request->description;
        $user_id = Auth::id();
        $imgId = $this->imageModel->addImage($request->img,$user_id)->id;
        $authority = 1;
        $video_path = $request->video;
        if($this->videoModel->saveVideo($name,$description,$user_id,$imgId,$authority,$video_path))
            return setData("200");
    }

    /*
    直接上传
    */
    public function upload(Request $request)
    {

    }

    public function getInfo(Request $request)
    {
        $aid = $request->aid;
        $type = $request->type;
        $output = shell_exec('/usr/bin/python3 ./python/bili.py '.$aid);
        // $output = shell_exec('python ./python/bili.py');
        // $curlobj = curl_init(); 
        // //设置访问的url
        // curl_setopt($curlobj, CURLOPT_URL, "http://9bl.bakayun.cn/API/GetVideoUrl.php"."?cid=".$aid."&quality=3&type".$type);
        // //执行后不直接打印出
        // curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);
        // $result=curl_exec($curlobj);
        return $output;
    }
}
