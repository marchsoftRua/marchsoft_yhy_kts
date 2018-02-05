<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;
use Modules\Main\Entities;

use Modules\Main\Entities\Type;

class Article extends Model
{
    protected $fillable = [];
    public $primaryKey = 'article_id';
    public $CommentModel;
    public $LabelModel;
    public function getIndexMainData($bycolumn,$status,$type,$getLimit){
        $query=DB::table('articles')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            });
        if ($status)  $query = $query->where("status",$status);
        if ($type)    $query = $query->where("article_type",$type);
        if ($bycolumn)$query = $query->orderby($bycolumn,"desc");
        $res= $query->paginate($getLimit);
        foreach ($res as $iteam){
            $id = $iteam->article_id;
            $iteam->CommentNum   =   $this->CommentModel->getCommentNumById($id);
            $iteam->article_label=   $this->LabelModel->GetArticleLabelById($id);
        }
        $tmpview=view('main::index.fillDatas.mainArea')->with("data",$res);
        $html=response($tmpview)->getContent();
        $getArray =json_decode(json_encode($res));
        $page_info ["current_page"]=$getArray->current_page;
        $page_info ["last_page"]=$getArray->last_page;
        $respose_ ["data"]=$page_info;
        $respose_ ["html"]=$html;
        return $respose_;
    }
    public function getMyArticle($Id){

        $query=DB::table('articles')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            })->where("article_id",$Id)->first();
        $query->CommentNum   =   $this->CommentModel->getCommentNumById($Id);
        $query->article_label=   $this->LabelModel->GetArticleLabelById($Id);
        return $query;
    }
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->LabelModel  =new Label();
        $this->CommentModel=new Comment();
    }

    public function Comments()
    {
        return $this->hasMany("Modules\Main\Entities\Comment",'article_id');
    }

    public function getWeekHotData()
    {
        $start = date('y-m-d h:i:s',strtotime('-7 day'));
        $end = date('y-m-d h:i:s',time());
        $query=DB::table('articles')
            ->addSelect(DB::raw('count(comment_id) as comment_num,articles.article_id,article_title'))
            ->leftJoin('comments', function ($join) {
                $join->on('articles.article_id', '=', 'comments.article_id');
            })->whereBetween("comments.created_at",[$start,$end])
            ->groupBy("articles.article_id")
            ->orderBy('comment_num', 'desc')
            ->take(10)
            ->get();
        return $query;
    }

    public function forUser()
    {
        return $this->belongsTo('Modules\Main\Entities\User','user_id','user_id');
    }

    public function forType()
    {
        return $this->belongsTo('Modules\Main\Entities\Type','type_id','type_id');
    }

    public function getArticleTable()
    {

        $collection = $this->all()->map(function ($item, $key) {
            $item['name'] = $item->forUser->name;
            $item['type_name'] = $item->forType->type_name;
            return $item;
        });
        return $collection;
    }
}
