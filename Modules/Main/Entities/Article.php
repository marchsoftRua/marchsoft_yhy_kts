<?php

namespace Modules\Main\Entities;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [];
    public $primaryKey = 'article_id';
}
