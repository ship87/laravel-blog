<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	public $url;

	private $categorySlug;

	/**
	 * @return mixed
	 */
	public function getUrl() {

		return $this->url;
	}

	/**
	 * @param mixed $url
	 */
	public function setUrl($url) {

		$this->url = $url;
	}

	/**
	 * @return mixed
	 */
	public function getCategorySlug() {

		return $this->categorySlug;
	}

	/**
	 * @param mixed $categorySlug
	 */
	public function setCategorySlug($categorySlug) {

		$this->categorySlug = $categorySlug;
	}

	public function comments()
	{
		return $this->hasMany('App\Models\Comment');
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