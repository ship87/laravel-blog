<?php

namespace App\Repositories;

use App\Models\Action;

class ActionRepository extends Repository
{
    public function __construct(Action $model)
    {
        $this->model = $model;
    }

    public function getAllNameId()
    {
        return $this->model->pluck('title','id')->all();
    }

    public function getId($actions)
    {
        return $actions->pluck('id')->all();
    }
}