<?php

namespace App\Repositories;

use App\Models\Tag;

class TagRepository extends Repository
{
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function getAllNameId()
    {
        return $this->model->pluck('title', 'id')->all();
    }

    public function getId($tags)
    {
        return $tags->pluck('id')->all();
    }
}