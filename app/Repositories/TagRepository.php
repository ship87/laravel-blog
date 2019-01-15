<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Interfaces\Repositories\RepositoryInterface;

class TagRepository extends Repository implements RepositoryInterface
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }
}