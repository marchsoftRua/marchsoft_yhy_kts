<?php

namespace Modules\Main\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Main\Entities\User;
// use App\User;

class MainController extends Controller
{
	public function login(Request $request)
	{
		if(Auth::check())
			return redirect('/admin');
		if($request->isMethod('post'))
		{
			$model = new User();
			$this->validate($request, [
		        'email' => 'required|email',
		        'password' => 'required|max:20|min:6',
		        'geetest_challenge' => 'geetest',
		    ],[
		    	'geetest' => config('geetest.server_fail_alert')
		    	]);
			return $model->validate($request);
		}
		else
			return view('main::mylogin');
	}

	public function layout(Request $request)
	{
		Auth::logout();
		return redirect('/');
	}

	public function register(Request $request)
	{
		if(Auth::check())
			return redirect('/admin');
		$this->validate($request, [
		    'user_playname' => 'required|max:12|min:5',
		    'email' => 'required|email',
		    'password' => 'required|max:20|min:6',
		]);
		$model = new User();
		if($model->addUser($request))
			return response()->json([
			    'code' => 200,
			    'msg' => '注册成功,三秒后自动跳转!'
			]);
		return response()->json([
		    'code' => 422,
		    'msg' => '注册失败,请刷新后重试!'
		]);
	}
}
