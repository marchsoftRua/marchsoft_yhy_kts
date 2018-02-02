<?php
/**
 * Created by PhpStorm.
 * User: KTS
 * Date: 2018/2/1
 * Time: 16:18
 */

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Label_article extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
    public static function GetLabelIdByArtcileId($id){
      $labels =  Label_article::where("label_id",$id)->get();
      return $labels;
    }
}