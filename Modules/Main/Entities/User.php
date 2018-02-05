<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class User extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
    public $timestamps = false;
    
    public function article()
    {
        return $this->hasOne('Modules\Main\Entities\Article');
    }

    public function getSpeakMoreUser()
    {
        $query=DB::table('users')
            ->addSelect(DB::raw('count(comment_id) as comment_num,user_playname,users.user_id,head_url'))
            ->leftJoin('comments', function ($join) {
                $join->on('comments.user_id', '=', 'comments.user_id');
            })->groupBy('user_id')->orderBy('comment_num')->take(20)->get();
        return $query;
    }

    public function validate($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) 
        {
            return redirect()->intended('/admin');//认证成功 重定向
        }
        else
        {
            return response()->json([
                'code' => '404',
                'msg' => '用户认证失败，账号或密码错误!'
            ]);
        }
    }
    public static function getUserNameById($id)
    {
       $user = $this->find($id);
       return $user;
    }

    public function addUser($request)
    {
        $user_playname = $request->input('user_playname');
        $user_email = $request->input('user_email');
        $user_password = $request->input('user_password');
        $this->user_playname = $user_playname;
        $this->user_email = $user_email;
        $this->user_password = Hash::make($user_password);
        $this->save();
        return true;
    }

    public function getAuthPassword () {
        return $this->user_password;
    }
}
