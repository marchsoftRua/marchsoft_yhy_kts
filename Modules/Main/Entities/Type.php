<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [];
    public static function getTypeList()
    {
    	$types = Type::all();
    	return $types;
    }
}
