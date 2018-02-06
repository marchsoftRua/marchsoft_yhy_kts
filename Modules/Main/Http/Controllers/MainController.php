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
		$this->validate($request, [
		    'user_playname' => 'required|max:12|min:5',
		    'user_email' => 'required|email',
		    'user_password' => 'required|max:20|min:6',
		]);
		$model = new User();
		if($model->addUser($request))
			return response()->json([
			    'code' => 200,
			    'msg' => '创建用户成功'
			]);
		return response()->json([
		    'name' => '422',
		    'state' => '创建用户失败'
		]);
	}
}
