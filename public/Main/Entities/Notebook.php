<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Notebook extends Model
{
    protected $guarded = ['geetest_challenge', 'geetest_validate', 'geetest_seccode'];
    protected $fillable = [];
}