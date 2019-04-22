<?php

namespace Tests;

use App\Models\Post;
use App\Models\User;

trait PostCreate
{
    protected $post;

    protected $user;

    public function createPost()
    {

        $this->user = factory(User::class)->create();

        $this->post = factory(Post::class)->create([
            'created_user_id' => $this->user->id,
            'updated_user_id' => $this->user->id,
        ]);
    }
}