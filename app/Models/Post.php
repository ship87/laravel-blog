<?php

namespace App\Models;

use App\Traits\Models\ElasticsearchTrait;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ElasticsearchTrait;

	public $seotitle;

	public $seodescription;

	public $seokeywords;

	public $url;

	protected $guarded = [];

	public function comments()
	{
		return $this->hasMany('App\Models\PostComment');
	}

	public function metatags()
	{
		return $this->hasMany('App\Models\Metatag');
	}

	public function tags()
	{
		return $this->belongsToMany('App\Models\Tag');
	}

	public function categories()
	{
		return $this->belongsToMany('App\Models\Category');
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