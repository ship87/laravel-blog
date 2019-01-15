<?php

namespace App\Repositories;

use App\Models\Metatag;
use App\Interfaces\Repositories\RepositoryInterface;

class MetatagRepository extends Repository implements RepositoryInterface
{
    public function __construct(Metatag $model)
    {
        $this->model = $model;
    }
}