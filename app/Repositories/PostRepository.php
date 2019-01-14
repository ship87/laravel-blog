<?php

namespace App\Repositories;

use App\Models\Post;

class TaskRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User $user
     * @return Collection
     */
    public function getPost($slug)
    {
        $search=Post::where('slug', $slug)->get();

        dd($search);

        //return ;
    }
}