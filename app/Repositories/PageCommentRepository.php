<?php

namespace App\Repositories;

use App\Models\PageComment;

class PageCommentRepository extends Repository
{
    public function __construct(PageComment $model)
    {
        $this->model = $model;
    }
}