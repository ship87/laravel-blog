<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Traits\AdminActions;

class CategoryService
{
    use AdminActions;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->baseRepo = $categoryRepo;
    }
}