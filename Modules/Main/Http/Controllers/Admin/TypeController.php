<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Main\Entities\Type;

class TypeController extends Controller
{
	var $typeModel = null;

	public function __construct()
	{
		$this->typeModel = new Type();
	}

    public function index(Request $request)
    {
        return view('main::admin.page.typeList');
    }

    public function showList(Request $request)
    {
    	return setData($this->typeModel->all());
    }

    public function addType(Request $request)
   	{
   		if($request->ajax())
   		{
   			$this->validate($request, [
            'name' => 'required|max:10|min:2|string',
        ]);
        if($this->typeModel->add($request))
          return setData(null);
        else
          return setData(null,"有问题请刷新");
   		}
   		else
   		{
   			  return "非ajax访问";
   		}
   		
   	}

}
