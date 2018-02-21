<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [];

    public function add($request)
    {
    	$this->type_name = $request->name;
    	return $this->save();
    }

}
