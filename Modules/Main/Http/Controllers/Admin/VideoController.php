<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Video;

class VideoController extends Controller
{
    var $videoModel = null;
    public function __construct()
    {
        $this->videoModel = new Video();
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
