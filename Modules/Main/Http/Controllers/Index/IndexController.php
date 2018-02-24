<?php

namespace Modules\Main\Http\Controllers\Index;
use Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Main\Entities\Comment;
use Modules\Main\Entities\Article;
use Modules\Main\Entities\Label;
use Modules\Main\Entities\User;
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
    var $UserModel=null;
    public function index()
    {
        $hotRank=$this->getTheWeekHot();
        $userRank=$this->getSpeakRank();
        return view('main::index.index')->with(
            [
                "hotRank"=>$hotRank,
               "userRank"=> $userRank
            ]);
    }
    public function showPerson_home(Request $request){
        $user_playname = $request->route( 'user_playname' );
        $user_id = User::getUserIdByPlayName($user_playname);
        $info = User::getUserNameById($user_id);
        $articles = Article::getUserArticleById($user_id);

        $comments = Comment::getUserCommentsById($user_id);

        return view( 'main::index.userHome' )
        ->with(
        [
          'info'=>$info,
          'articles'=>$articles,
          'comments'=>$comments
        ]
        );
    }
    public function error_page(){
        return view('main::index.layouts.404');
    }
    public function readerSetData(Request $request){
        $bycolumn = $this->sortK_V[$request->bycolumn];
        $status   = $request->status;
        $type     = $request->type;
        $getLimit = $request->getLimit;
        $getdata  = $this->ArticleModel->getIndexMainData($bycolumn,$status,$type,$getLimit);
        return $getdata;
    }
    public function __construct(){
        $this->ArticleModel=new Article();
        $this->LabelModel  =new Label();
        $this->CommentModel=new Comment();
        $this->UserModel   = new User();
    }
    public function  getTheWeekHot(){
        $data = $this->ArticleModel->getWeekHotData();
        return $data;
    }
    public function getSpeakRank(){
        return  $this->UserModel->getSpeakMoreUser();
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
