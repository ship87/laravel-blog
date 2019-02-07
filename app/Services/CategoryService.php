<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateTrait;

class CategoryService
{
    use AdminPageTrait;

    use CreateUpdateTrait;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->baseRepo = $categoryRepo;
    }

	public function getAllTitles()
	{
		return $this->baseRepo->getAllTitles();
	}
}