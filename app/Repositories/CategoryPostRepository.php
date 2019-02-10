<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;

class CategoryPostRepository
{
    protected $modelCategory;

    protected $modelPost;

    public function __construct(Category $modelCategory, Post $modelPost)
    {
        $this->modelCategory = $modelCategory;
        $this->modelPost = $modelPost;
    }

    public function saveMany(Post $post, array $categories)
    {
        return $post->categories()->sync($categories);
    }
}