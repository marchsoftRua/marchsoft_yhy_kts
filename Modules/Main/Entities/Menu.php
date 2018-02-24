<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [];
    public $timestamps = false;

    public function sidenavs()
    {
        return $this->hasMany('Modules\Main\Entities\Sidenav');
    }

    public function selectAll()
    {
    	return $this->all()->mapWithKeys(function ($item) {
    		return [$item->name=>$item->sidenavs];
		});
    }
}
