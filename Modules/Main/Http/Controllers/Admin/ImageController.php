<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Main\Entities\Image;



class ImageController extends Controller
{
    public function index(Request $request)/////封面上传　
    {
        $model = new Image();
        $src = $model->cacheImg($request);
        $data['src'] = $src;
        return setData($data);
    }
    

}
