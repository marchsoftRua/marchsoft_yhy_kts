<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
    public function article(){
        return $this->hasOne('Modules\Main\Entities\Article',"user_id","user_id");
    }
}
