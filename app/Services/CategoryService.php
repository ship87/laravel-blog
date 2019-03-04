<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;
use App\Traits\Services\MergeNewDataTrait;

class CategoryService
{
    use AdminPageTrait,CreateUpdateSlugTrait,MergeNewDataTrait;

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