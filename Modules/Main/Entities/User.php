<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;
class User extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
    public function article(){
        return $this->hasOne('Modules\Main\Entities\Article',"user_id","user_id");
    }
    public function getSpeakMoreUser(){
        $query=DB::table('users')
            ->addSelect(DB::raw('count(comment_id) as comment_num,user_playname,users.user_id,head_url'))
            ->leftJoin('comments', function ($join) {
                $join->on('comments.user_id', '=', 'comments.user_id');
            })->groupBy('user_id')->orderBy('comment_num')->take(20)->get();
        return $query;
    }
    public static function getUserNameById($id){
       $user =   User::where('user_id',$id);
       return $user;
    }
}
