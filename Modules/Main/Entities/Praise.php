<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Praise extends Model
{
    protected $fillable = [];
    public static function addPraise($arr)
    {
    	$praise_type=$request['praise_type'];
        $obj_id = $request['obj_id'];
        $praise_from = getUserInfo()->id;
    	Praise::insert(
    		[

    		]
    	);
    }
}
