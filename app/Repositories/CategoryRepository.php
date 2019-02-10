<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

	public function getAllTitleId()
	{
		return $this->model->pluck('title','id')->all();
	}

	public function getId($categories)
	{
		return $categories->pluck('id')->all();
	}
}