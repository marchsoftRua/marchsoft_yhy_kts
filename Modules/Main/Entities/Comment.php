<?php

namespace Modules\Main\Entities;
use Illuminate\Http\Request;
use Modules\Main\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Main\Entities\Group;
class Comment extends Model
{
    protected $fillable = [];
    public static function getCommentNumById($id){
       $num = Comment::where("comment_id",$id)->count();
       return $num;
    }
    public function getOneGrade($w_id,$orderBy){
        $OneGrade=Comment::where('parent_id',0)
        ->where('article_id',$w_id)
        ->orderBy($orderBy,"desc")
        ->paginate(5);
        foreach ($OneGrade as $item){
            $item->childs = $this->getChild($item->comment_id,$w_id);
        }
        return $OneGrade;
    }
    public function getChild($p_id,$w_id,$getLimit=3){
        $OneGrade=Comment::where('parent_id',$p_id)->where('article_id',$w_id)->paginate($getLimit);
        return json_en_de_code($OneGrade);
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
