<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends Repository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}