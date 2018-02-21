<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Modules\Main\Entities\Lable;
class LableController extends Controller
{
    public function index(Request $request)
    {
        return view('main::admin.page.lableList');
    }
}
