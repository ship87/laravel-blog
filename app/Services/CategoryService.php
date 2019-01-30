<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
	protected $categoryRepo;

	public function __construct(CategoryRepository $categoryRepo)
	{
		$this->categoryRepo = $categoryRepo;
	}

	public function getPaginated($path)
	{
		$categories = $this->categoryRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}
}