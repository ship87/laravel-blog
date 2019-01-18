<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
	}

	public function metatags()
	{
		return $this->hasMany('App\Models\Metatag');
	}

	public function createdUser()
	{
		return $this->hasOne('App\Models\User','id','created_user_id');
	}

	public function updatedUser()
	{
		return $this->hasOne('App\Models\User','id','updated_user_id');
	}

}
