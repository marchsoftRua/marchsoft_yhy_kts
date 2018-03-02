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
    public static function getUserArticleById($id){
        return Article::where('user_id',$id)->orderBy('created_at','desc')->take(10)->get();
    }
    public function getIndexMainData($bycolumn,$status,$url,$getLimit){
        $query=DB::table('articles')
            ->join('users', function ($join) {
                $join->on('users.id', '=', 'articles.user_id');
            });
        $type = $url!='/'?Type::getTypeByUrl($url)->id:0;
            Log::info('类型'.$type."状态".$status);

        if ($status) 
             $query = $query->where("status",$status);
         else{
            if ($type)    $query = $query->where("type_id",$type);
            if ($bycolumn)$query = $query->orderby($bycolumn,"desc");  
         }
        $res= $query->paginate($getLimit);
        foreach ($res as $iteam){
            $id = $iteam->id;
            $iteam->CommentNum   =   $this->CommentModel->getCommentNumById($id);
            $iteam->article_label=   $this->LabelModel->GetArticleLabelById($id);
            // mb_substr($iteam->article_content,0,100,"utf-8")
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
    public  static function getOneArticle($Id){
       return Article::where('id',$Id)->first();
    }
    public static function getAuthorByWid($wid){
        $wz= Article::where('id',$wid)->first();
        return $wz->user_id;
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

    public function Image()
    {
        return $this->hasOne('Modules\Main\Entities\Image','id','image_id');
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
    public static function getArticleById($id){
        return Article::where('id',$id)->first();
    }


    public function add($request,$img_id=null)
    {

        $this->change($request,$this,$img_id);
    }

    public function change($request,$model=null,$img_id=null)
    {
        if($model==null)
            $model = $this;
        $model->article_title = $request->title;
        $model->article_content = $request->content;
        $model->summary = $request->summary;
        $model->status = 1;//后期再改
        $model->type_id = $request->type;
        if($img_id)
            $model->image_id = $img_id;
        $model->user_id = Auth::id();
        $model->authority = Auth::user()->user_type;
        $model->save();
    }

}
