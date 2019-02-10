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

	public function getAllTitleId()
	{
		return $this->baseRepo->getAllTitleId();
	}

	public function getId($categories)
	{
		return $this->baseRepo->getId($categories);
	}
}