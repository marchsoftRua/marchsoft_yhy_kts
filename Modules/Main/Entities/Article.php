<?php
namespace Modules\Main\Entities;
use Illuminate\Database\Eloquent\Model;
use DB;
use Log;
use Modules\Main\Entities;
use Illuminate\Support\Facades\Auth;
use Modules\Main\Entities\Type;
class Article extends Model
{
    protected $fillable = [];
    public $CommentModel;
    public $LabelModel;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->LabelModel  =new Label();
        $this->CommentModel=new Comment();
    }


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
            $id = $iteam->id;
            $iteam->CommentNum   =   $this->CommentModel->getCommentNumById($id);
            $iteam->article_label=   $this->LabelModel->GetArticleLabelById($id);
        }
        $getArray =json_decode(json_encode($res));
        $tmpview=view('main::index.fillDatas.mainArea')->with("data",$getArray->data);
        $html=response($tmpview)->getContent();
        $page_info ["current_page"]=$getArray->current_page;
        $page_info ["last_page"]=$getArray->last_page;
        $respose_ ["data"]=$page_info;
        $respose_ ["html"]=$html;
        return $respose_;
    }
    public function getOneArticle($Id){
       return $this->where('id',$Id)->get();
    }
    public function getMyArticle($Id){

        $query=DB::table('articles')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            })->where("articles.id",$Id)->first();
        if (!$query) {
           return null;
        }
        $query->CommentNum   =   $this->CommentModel->getCommentNumById($Id);
        $query->article_label=   $this->LabelModel->GetArticleLabelById($Id);
        return $query;
    }


    public function Comments()
    {
        return $this->hasMany("Modules\Main\Entities\Comment",'belong_id');
    }

    public function getWeekHotData()
    {
        $start = date('y-m-d h:i:s',strtotime('-7 day'));
        $end = date('y-m-d h:i:s',time());
        $query=DB::table('articles')
            ->addSelect(DB::raw('count(comments.id) as comment_num,articles.id,article_title'))
            ->Join('comments', function ($join) {
                $join->on('articles.id', '=', 'comments.belong_id');
            })->whereBetween("comments.created_at",[$start,$end])
            ->groupBy("articles.id")
            ->orderBy('comment_num', 'desc')
            ->take(10)
            ->get();
        return $query;
    }

    public function forUser()
    {
        return $this->belongsTo('Modules\Main\Entities\User','user_id','id');
    }

    public function forType()
    {
        return $this->belongsTo('Modules\Main\Entities\Type','type_id','id');
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

    public function add($request,$img_id=null)
    {

        $this->article_title = $request->title;
        $this->article_content = $request->content;
        $this->summary = $request->summary;
        $this->type_id = $request->type;
        if($img_id)
            $this->image_id = $img_id;
        $this->user_id = Auth::id();
        $this->authority = Auth::user()->user_type;
        $this->save();
    }

}
