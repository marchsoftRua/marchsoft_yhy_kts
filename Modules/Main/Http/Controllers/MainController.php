<?php

namespace Modules\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MainController extends Controller
{
	public function login(Request $request)
	{
		return view('main::mylogin');
	}
	public function register()
	{

	}
}
