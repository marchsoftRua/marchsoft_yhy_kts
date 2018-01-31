<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
}
