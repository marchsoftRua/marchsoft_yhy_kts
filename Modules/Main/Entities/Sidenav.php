<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Sidenav extends Model
{
    protected $fillable = [];
    public $timestamps = false;

    public function selectAll()
    {
    	return $this->all();
    }
}
