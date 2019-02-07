<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

	public function getAllTitles()
	{
		return $this->model->pluck('title','id')->all();
	}
}