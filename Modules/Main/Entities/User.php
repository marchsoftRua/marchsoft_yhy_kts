<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use DB;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function article()
    {
        return $this->hasOne('Modules\Main\Entities\Article');
    }

    public function getSpeakMoreUser()
    {
        $query=DB::table('users')
            ->addSelect(DB::raw('count(comments.id) as comment_num,user_playname,users.id,head_url'))
            ->leftJoin('comments', function ($join) {
                $join->on('users.id', '=', 'comments.user_id');
            })->groupBy('users.id')->orderBy('comment_num')->take(20)->get();
        return $query;
    }
    public function validate($request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) 
        {
            // return redirect('/admin');//认证成功 重定向
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
       $user = User::find($id);
       return $user;
    }

    public function addUser($request)
    {
        $user_playname = $request->input('user_playname');
        $email = $request->input('user_email');
        $password = $request->input('password');
        $this->user_playname = $user_playname;
        $this->email = $email;
        $this->password = Hash::make($password);
        $this->save();
        return true;
    }

    public function getAuthPassword () {
        return $this->password;
    }
}
