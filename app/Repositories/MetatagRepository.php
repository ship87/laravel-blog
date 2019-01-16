<?php

namespace App\Repositories;

use App\Models\Metatag;

class MetatagRepository extends Repository
{
    public function __construct(Metatag $model)
    {
        $this->model = $model;
    }
}