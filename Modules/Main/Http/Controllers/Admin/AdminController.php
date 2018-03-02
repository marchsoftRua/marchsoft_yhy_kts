<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Main\Entities\Menu;
use Modules\Main\Entities\User;
use Modules\Main\Entities\Image;
use Modules\Main\Rules\Phone;
use Illuminate\Validation\Rule;
use Modules\Main\Entities\Article;
use Modules\Main\Entities\Type;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    var $userModel = null;
    var $imageModel = null;
    var $menuModel = null;
    public function __construct()
    {
        $this->userModel = new User();
        $this->imageModel = new Image();
        $this->menuModel = new Menu();
    }

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
        $data = $this->menuModel->selectAll();
        return $data;
    }

    public function articlePage()
    {
        return view('main::admin.page.articleList');
    }

    public function userInfoShow(Request $request)
    {
        if($request->isMethod('post'))
        {
            $this->validate($request,[
                'realName' => 'required|string|max:10',
                'sex' => 'required|boolean',
                'userPhone' => ['nullable',new Phone],
                'userBirthday' => 'date|nullable',
                'province' => 'nullable|string|max:10',
                'city' => 'nullable|string|max:10',
                'area' => 'nullable|string|max:10',
                'userEmail' => 'required|email',
                'myself' => 'nullable|string|max:120'
            ]);
            if($this->userModel->setInfo($request))
                return setData(null);
        }
        else
            return view('main::admin.page.userInfo')->withUser(Auth::user());
    }
    public function changeImage(Request $request)
    {
        if(!$request->isMethod('post'))
            return redirect('/admin');
        $image_id = $this->imageModel->saveUserImg($request);
        $user = User::find(Auth::user()->id);
        $user->head_url = Image::find($image_id)->image_path;
        $user->save();
        return setData(['url'=>$user->head_url],'修改成功!');
    }
    public function changepwd(Request $request)
    {
        if($request->isMethod('get'))
            return view('main::admin.page.userpwd')->withUser(Auth::user());
        else
        {
            $this->validate($request,[
                'newpwd' => 'required|confirmed|max:20|min:6',
                'newpwd_confirmation'=>'required'
            ]);
            if($this->userModel->setPwd($request))
                return setData(null);
        }
    }
    public function  changeArticle(Request $request,$article_id)
    {
        if($request->isMethod('get'))
        {
            return view('main::admin.page.addarticle')->withArticle(Article::find($article_id))->withTypes(Type::all());
        }

    }
}
