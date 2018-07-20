<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Video;
use Modules\Main\Entities\Image;
use Modules\Main\Entities\Type;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    var $videoModel = null;
    public $imageModel = null;
    public $typeModle = null;
    public function __construct()
    {
        $this->videoModel = new Video();
        $this->imageModel = new Image();
        $this->typeModle = new Type();
    }   

    public function index(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('main::admin.page.video.addvideo')->with('types',$this->typeModle->all());
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
    public function uploadVideo(Request $request)
    {
        // $this->videoModel->downloadVideo($request);//保存用户上传的ｖｉｄｅｏ
        $this->validate($request, [
            'name' => 'required|max:50|String',
            'type' => 'required|Integer',
            'description' => 'String|max:120',
            'pathList' => 'required|array',
            'img' => 'required'
        ]);
       $data = $this->videoModel->downloadVideo($request->pathList[0],$request->img);
       $img_id = $this->imageModel->addImage($data[1],Auth::id())->id;//保存图片进入数据库
       $this->videoModel->saveVideo($request->name,$request->description,Auth::id(),$img_id,0,$data[0]);
       return setData("视频上传成功！");
    }

    public function cacheVideo(Request $request)
    {
        $path = $this->videoModel->cacheVideo($request->file);
        $imgPath = $this->videoModel->returnImg($path);
        return setData(array($path,$imgPath),"上传成功");
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
