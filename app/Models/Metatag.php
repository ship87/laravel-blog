<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metatag extends Model
{
	public $timestamps = false;

	protected $guarded = [];

	public function post()
	{
		return $this->belongsTo('App\Models\Post');
	}

	public function page()
	{
		return $this->belongsTo('App\Models\Page');
	}
}
