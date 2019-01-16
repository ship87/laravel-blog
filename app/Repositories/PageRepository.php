<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends Repository
{
    public function __construct(Page $model)
    {
        $this->model = $model;
    }
}