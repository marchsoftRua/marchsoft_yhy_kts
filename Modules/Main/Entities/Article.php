<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;
use Modules\Main\Entities;
class Article extends Model
{
    protected $fillable = [];
    public $primaryKey = 'article_id';
    public function getIndexMainData($bycolumn,$status,$type,$getLimit){
        $query=DB::table('articles')
            ->join('users', function ($join) {
                $join->on('users.user_id', '=', 'articles.user_id');
            });
        if ($status)  $query = $query->where("status",$status);
        if ($type)    $query = $query->where("article_type",$type);
        if ($bycolumn)$query = $query->orderby($bycolumn,"desc");
        $res= $query->paginate($getLimit);
        return $res;
    }
    public function getWeekHotData()
    {
       return Article::find(0)->Comments();
    }

    public function Comments()
    {
        return $this->hasMany("Modules\Main\Entities\Comment",'article_id');
    }
}
