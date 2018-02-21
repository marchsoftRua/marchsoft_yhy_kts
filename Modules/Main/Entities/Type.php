<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [];

    public function add($request,$color)
    {
    	$this->type_name = $request->name;
    	$this->type_color = $color;
    	return $this->save();
    }

}
