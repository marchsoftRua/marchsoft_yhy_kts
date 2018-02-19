<?php

namespace Modules\Main\Http\Controllers\Admin;
use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Article;
use Modules\Main\Entities\Image;
use Modules\Main\Entities\Type;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $model = new Article();
            $img = new Image();
            $img_id = $img->saveArticleImg($request->imgpath);
            $model->add($request,$img_id);
        }
        else
        {
            $typeModle = new Type();
            return view('main::admin.page.addarticle')->with('types',$typeModle->all());
        }
    }
    public function showList(Request $request)
    {
        $model = new Article();
        return setData($model->getArticleTable());
    }


}
