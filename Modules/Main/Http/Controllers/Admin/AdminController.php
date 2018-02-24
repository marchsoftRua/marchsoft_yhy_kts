<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Main\Entities\Menu;
use Modules\Main\Entities\User;
use Modules\Main\Entities\Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        
        return view('main::admin.index')->with('user',Auth::user());
    }

    public function navData(Request $request)
    {
        if(!$request->ajax())
        {
            return "非ajax请求";
        }
        $model = new Menu();
        $data = $model->selectAll();
        return $data;
    }

    public function articlePage()
    {
        return view('main::admin.page.articleList');
    }

    public function userInfoShow()
    {
        return view('main::admin.page.userInfo')->withUser(Auth::user());
    }
    public function changeImage(Request $request)
    {
        if(!$request->method('post'))
            return redirect('/admin');
        $model = new Image();
        $image_id = $model->saveUserImg($request);
        $user = User::find(Auth::user()->id);
        $user->head_url = Image::find($image_id)->image_path;
        $user->save();
        return setData(['url'=>$user->head_url],'修改成功!');
    }
}
