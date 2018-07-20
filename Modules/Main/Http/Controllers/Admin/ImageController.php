<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Image;



class ImageController extends Controller
{
    public function index(Request $request)/////缓存图片并返回地址　
    {
        $model = new Image();
        $src = $model->cacheImg($request->img);
        $data['src'] = $src;
        return setData($data);
    }
    
  //   public function saveVideoImage(Request $request)
  //   {
		// $model = new Image();
		// $src = $model->cacheImg($request->img);
  //   }

}
