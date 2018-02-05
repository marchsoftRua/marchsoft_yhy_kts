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
        return $this->hasOne('Modules\Main\Entities\Article',"user_id","user_id");
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


        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // 认证通过...
            return redirect()->intended('dashboard');
        }
    }
    public static function getUserNameById($id)
    {
       $user = User::where('user_id',$id);
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
}
