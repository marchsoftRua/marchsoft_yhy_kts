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
    public static function getCommentNumById($id){
       $num = Comment::where("id",$id)->count();
       return $num;
    }
    public function getOneGrade($w_id,$orderBy,$type=1){
        $OneGrade=Comment::where('parent_id',0)
        ->where('belong_id',$w_id)
        ->where('type',$type)
        ->orderBy($orderBy,"desc")
        ->paginate(5);
        foreach ($OneGrade as $item){
            $item->childs = $this->getChild($item->id,$w_id);
            $fromuser = User::getUserNameById($item->user_id);
            $item->from_name=$fromuser->name;
        }
        return $OneGrade;
    }
    public function getChild($p_id,$w_id,$getLimit=3,$type=1){
        $OneGrade=Comment::where('parent_id',$p_id)
        ->where('belong_id',$w_id)
        ->where('type',$type)
        ->paginate($getLimit);
        $res = json_en_de_code($OneGrade);
        foreach ($res->data as $value) {
            $p_id = $value->parent_id;
            $ct = Comment::getCommentById($p_id);
            $fromuser = User::getUserNameById($value->user_id);
            $touser = User::getUserNameById($ct->user_id);
            $value->parent_name=$touser->name;
            $value->from_name=$fromuser->name;
        }
        return $res;
    }
    public static function getCommentById($id){
        $res = Comment::find($id);
        return $res;
    }
    public function addComment($data)
    {

        $this->insert(
        [
            'belong_id'=>$data['belong_id'],
            'type'=>1,
            'comment_inner'=>$data['content'],
            'user_id'=>1,
            'parent_id'=>$data['p_id'],
            'created_at'=>date('y-m-d h:i:s',time())
        ]);      
    }
    public function comment_delete($type,$id)
    {
        
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
