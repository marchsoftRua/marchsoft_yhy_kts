<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [];
    public static function getCommentNumById($id){
       $num = Comment::where("comment_id",$id)->count();
       return $num;
    }
}
