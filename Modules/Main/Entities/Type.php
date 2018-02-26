<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Type extends Model
{
    protected $fillable = [];
    public static function getTypeList()
    {
    	$types = Type::paginate(8);
    	return json_en_de_code($types);
	}
    public function add($request)
    {
    	$this->type_name = $request->name;
    	$this->user_id = Auth::id();
    	$this->save();
    	return $this->all()->last()->id;
    }
    public  static function getTypeByUrl($value)
    {
    	return Type::where('url',$value)->first();
    	# code...
    }
    public function user()
    {
    	return $this->belongsTo('Modules\Main\Entities\User');
    }
    public function typeList()
    {
    	$data = $this->all()->each(function($item, $key){
    		$name = $item->user()->select('name');
    		$item['name'] = $name->first()->name;

    	});
    	return $data;
    }
}
