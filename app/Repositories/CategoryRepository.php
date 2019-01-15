<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\Repositories\RepositoryInterface;

class CategoryRepository extends Repository implements RepositoryInterface
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}