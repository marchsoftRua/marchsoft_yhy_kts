<?php
namespace Modules\Main\Http\Controllers;
use Germey\Geetest\CaptchaGeetest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;
/**
 * Created by PhpStorm.
 * User: KTS
 * Date: 2018/1/31
 * Time: 22:44
 */
class AuthController extends Controller{
    use CaptchaGeetest;
    public function loginAuth(Request $request){

    }
    public function register(Request $request){

    }
    public function postValidate(Request $request)
    {
        $result = $this->validate($request, [
            'geetest_challenge' => 'geetest',
        ], [
            'geetest' => config('geetest.server_fail_alert')
        ]);
        if ($request) {
            return 'success';
        }
    }


}