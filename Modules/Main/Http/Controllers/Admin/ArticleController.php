<?php

namespace Modules\Main\Http\Controllers\Admin;
use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Main\Entities\Comment;
use Modules\Main\Entities\Article;
use Modules\Main\Entities\Type;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    var $articleModel=null;
    var $commentModel=null;
    public function index(Request $request)
    {

        if($request->ajax())
        {
            echo "aaa";
        }
        else
        {
            $typeModle = new Type();
            return view('main::admin.page.addarticle')->with('types',$typeModle->all());
        }
    }
    public function __construct()
    {
        $this->articleModel = new Article();
        $this->commentModel = new Comment();
    }

    public function lookArticle(Request $request){
        $id = $request->route( 'article_id' );
        if (!$id){
            return redirect()->back();
        }
        $data = $this->articleModel->getMyArticle($id);
        return view('main::Index.article')->with(["data"=>$data]);
    }
    public function getComments(Request $request){
        $id = $request->article_id ;
       $Comments =  $this->commentModel->getOneGrade($id);
       $tmpview = view('main::Index.fillDatas.comment')->with('comment',$Comments);
       $html = response($tmpview)->getContent();
       return $html;
    }

    public function showList(Request $request)
    {
        $model = new Article();
        return setData($model->getArticleTable());
    }


}
