<?php

namespace Modules\Main\Entities;
use Illuminate\Http\Request;
use Modules\Main\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Main\Entities\Group;
use Log;
class Comment extends Model
{
    protected $fillable = [];
    const TYPE_ARTICLE=1;//1代表文章2代表视频 ...
    const TYPE_VEDIO=2;
    public static function getCommentNumById($id){
       $num = Comment::where("id",$id)->count();
       return $num;
    }
    public function getOneGrade($w_id,$orderBy,$type=1,Request $request){
        $OneGrade=Comment::where('parent_id',0)
        ->where('belong_id',$w_id)
        ->where('type',$type)
        ->orderBy($orderBy,"desc")
        ->paginate(5);
        $request['page']=1;
        $OneGrade->author = Article::getAuthorByWid($w_id);
        // Log::info("+++".$OneGrade->author);
        foreach ($OneGrade as $item){
            $item->childs = $this->getChild($item->id,$w_id);
            $fromuser = User::getUserNameById($item->user_id);
            $item->from_name=$fromuser->name;
            $item->playname=$fromuser->user_playname;
        }
        return $OneGrade;
    }
    public static function getUserCommentsById($id){
        // 最近评论
        $comments = Comment::where('user_id',$id)->orderBy('created_at','desc')->take(10)->get();
        foreach ($comments as $value) {
            //Article类可扩展
            $value->article_info = Article::getOneArticle($value->belong_id);
        }
        return $comments;
    }
    public function getChild($p_id,$w_id,$getLimit=3,$type=1){
        $OneGrade=Comment::where('parent_id',$p_id)
        ->where('belong_id',$w_id)
        ->where('type',$type)
        ->paginate($getLimit);
        $res = json_en_de_code($OneGrade);
        $res->author = Article::getAuthorByWid($w_id);
        
        foreach ($res->data as $value) {
            // $p_id = $value->rec_id;
            // $ct = Comment::getCommentById($p_id);
            $sender = User::getUserNameById($value->user_id);
            $geter = User::getUserNameById($value->rec_id);
            $value->rec_user=$geter;
            $value->send_user=$sender;
        }
        return $res;
    }
    public static function getCommentById($id){
        $res = Comment::find($id);
        return $res;
    }
    public function addComment($data)
    {
        date_default_timezone_set('PRC'); 
        $user = getUserInfo();
        $this->insert(
        [
            'belong_id'=>$data['belong_id'],
            'type'=>1,
            'comment_inner'=>$data['content'],
            'user_id'=>$user->id,
            'rec_id'=>$data['toid'],
            'parent_id'=>$data['p_id'],
            'created_at'=>date('y-m-d h:i:s',time())
        ]);
    }
    public function comment_delete($type,$w_id,$c_id)
    {
        if ($this->belongVerify($type,$w_id)) {
            // 删除
            $this->delete_child($c_id);
            $this->where('type',$type)->where('id',$c_id)->delete();
            return 1;
        }
        return 0;
    }
    public function delete_child($p_id)
    {
        $this->where('parent_id',$p_id)->delete();
    }
    public function belongVerify($type,$b_id){
        switch ($type) {
            case self::TYPE_ARTICLE:
                $belong = Article::getArticleById($b_id);
                break;
            case self::TYPE_VEDIO:
                break;
        }
        $user = User::getUserNameById($belong->user_id);
        $my = getUserInfo();
        if ($user->id==$my->id) {
            return true;
        }
        return false;
    }
//    public  function getComment($p_id,$belongTo){
//        $childs=Comment::where('parent_id',$p_id)->where('article_id',$belongTo)->get();
//        if (count($childs)<1 )return null;
//        $data=[];
//        foreach ($childs as $item){
//            $user = User::getUserNameById($item->user_id);
//            $item=$this->getComment($item->comment_id);
//            $item->user_playname=$user->playname;
//            $item->head_url=$user->head_url;
//            $item->group_name=Group::getGropNameById($item->group_id);
//            $data+=$item;
//        }
//        return $data;
//    }
}
