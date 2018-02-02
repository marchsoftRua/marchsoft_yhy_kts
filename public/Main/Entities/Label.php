<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
    public static function GetArticleLabelById($id){
       $arr =  Label::whereIn("label_id",Label_article::GetLabelIdByArtcileId($id));
       return $arr;
    }
}
