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
		$this->type = new Type();
	}

    public function index(Request $request)
    {
        return view('main::admin.page.typeList');
    }

    public function showList(Request $request)
    {
    	return setData($this->type->all());
    }

    public function addType(Request $request)
   	{
   		if($request->method('get'))
   		{
   			return view('main::admin.page.addType');
   		}
   		else
   		{
   			$this->validate($request, [
		        'name' => 'required|unique:posts|max:255',
		        'color' => 'max:20|string|nullable',
	    	]);
    		return $this->typeModel->add();
   		}
   		
   	}

}
