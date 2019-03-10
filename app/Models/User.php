<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function post()
	{
		return $this->belongsTo('App\Models\Post');
	}

	public function page()
	{
		return $this->belongsTo('App\Models\Page');
	}

	public function role()
	{
		return $this->belongsTo('App\Models\Role');
	}
}
