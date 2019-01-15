<?php

namespace App\Repositories;

use App\Models\Page;
use App\Interfaces\Repositories\RepositoryInterface;

class PageRepository extends Repository implements RepositoryInterface
{
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}