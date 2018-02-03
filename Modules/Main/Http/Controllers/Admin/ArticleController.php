<?php

namespace Modules\Main\Http\Controllers\Admin;
use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Main\Entities\Comment;
use Modules\Main\Entities\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    var $articleModel=null;
    var $commentModel=null;
    public function index()
    {
        return view('main::index');
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
        if(!$request->ajax())
            return "非ajax请求";
        return null;
    public function setData($data)
    {
        $dataArr =array("code"=>0,"msg"=>"","count"=>1,"data"=>$data);
        return $dataArr;
    }

    public function showList(Request $request)
    {
        $model = new Article();
        return $this->setData($model->getArticleTable());
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('main::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('main::show');
    }



}
