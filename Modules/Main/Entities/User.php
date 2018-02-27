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
    public $timestamps = false;
    
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
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
            return redirect('/admin');//认证成功 重定向
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
    public static function getUserIdByPlayName($PlayName)
    {
       $user = User::where('user_playname',$PlayName)->first();

       return $user->id;
    }
    public function addUser($request)
    {
        $user_playname = $request->input('user_playname');
        $email = $request->input('email');
        $password = $request->input('password');
        $this->user_playname = $user_playname;
        $this->email = $email;
        $this->password = Hash::make($password);
        $this->save();
        $this->validate($request);
        return true;
    }

    public function getAuthPassword () {
        return $this->password;
    }

    public function setInfo($request)
    {
        $user = $this->find(Auth::id());
        $user->name = $request->realName;
        $user->sex = $request->sex;
        $user->userPhone = $request->userPhone;
        $user->birthday = $request->userBirthday;
        $user->province = $request->province;
        $user->city = $request->city;
        $user->area = $request->area;
        $user->myself = $request->myself;
        $user->save();
        return true;
    }

    function setPwd($request)
    {
        $user = $this->find(Auth::id());
        if(Hash::check($request->oldpwd, $user->password))
        {
            $user->password = Hash::make($request->newpwd);
            $user->save();
            return true;
        }
        else
            return false;
    }

}
