<?php

namespace App\Repositories;

use App\Models\Post;
use App\Interfaces\Repositories\RepositoryInterface;

class PostRepository extends Repository implements RepositoryInterface
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }
}