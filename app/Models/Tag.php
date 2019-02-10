<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public $timestamps = false;

	protected $guarded = [];

	public function posts()
	{
		return $this->belongsToMany('App\Models\Post');
	}
}
