<?php

namespace Modules\Main\Http\Controllers\Index;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Main\Entities\Comment;
use Modules\Main\Entities\Article;
use Modules\Main\Entities\Label;
class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    var $sortK_V=[null,"shame","readnum","articles.created_at"];//排序依据
    var $ArticleModel=null;
    var $CommentModel = null;
    var $LabelModel = null;
    public function index()
    {
        return view('main::index.index');
    }
    public function readerSetData(Request $request){
        $bycolumn = $this->sortK_V[$request->bycolumn];
        $status   = $request->status;
        $type     = $request->type;
        $getLimit = $request->getLimit;
        $getdata  = $this->ArticleModel->getIndexMainData($bycolumn,$status,$type,$getLimit);
        foreach ($getdata as $iteam){
            $id = $iteam->article_id;
            $iteam->CommentNum   =   $this->CommentModel->getCommentNumById($id);
            $iteam->article_label=   $this->LabelModel->GetArticleLabelById($id);
        }
        $tmpview=view('main::index.fillDatas.mainArea')->with("data",$getdata);
        $html=response($tmpview)->getContent();
        $getArray =json_decode(json_encode($getdata));
        $page_info ["current_page"]=$getArray->current_page;
        $page_info ["last_page"]=$getArray->last_page;
        $respose_ ["data"]=$page_info;
        $respose_ ["html"]=$html;
        return $respose_;
    }
    public function __construct(){
        $this->ArticleModel=new Article();
        $this->CommentModel=new Comment();
        $this->LabelModel  =new Label();
    }
    public function  getTheWeekHot(){
        return $this->ArticleModel->getWeekHotData();
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

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('main::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

}
