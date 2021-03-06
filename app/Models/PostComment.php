<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    public $url;

    protected $guarded = [];

    public function createdUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_user_id');
    }

    public function updatedUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'updated_user_id');
    }
}
