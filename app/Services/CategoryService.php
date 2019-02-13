<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateSlugTrait;
use App\Traits\CreateUpdateTrait;

class CategoryService
{
    use AdminPageTrait;

    use CreateUpdateSlugTrait;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->baseRepo = $categoryRepo;
    }

    public function getAllTitleId($excludeCategory = false)
    {
        return $this->baseRepo->getAllTitleId($excludeCategory);
    }

    public function getId($categories)
    {
        return $this->baseRepo->getId($categories);
    }
}