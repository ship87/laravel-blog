<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Interfaces\Repositories\RepositoryInterface;

class CommentRepository extends Repository implements RepositoryInterface
{
    public function __construct(Comment $model)
    {
        $this->model = $model;
    }
}