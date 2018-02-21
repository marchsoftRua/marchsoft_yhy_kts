<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Sidenav extends Model
{
    protected $fillable = [];
    public $timestamps = false;

    /*
combine 方法可以将一个集合的值作为「键」，再将另一个数组或者集合的值作为「值」合并成一个集合：
    */

    public function selectAll()
    {
    	return $this->all()->keyBy('menuname');
    }
    
}
