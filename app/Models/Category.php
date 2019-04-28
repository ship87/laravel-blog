<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}