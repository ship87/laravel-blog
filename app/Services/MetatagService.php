<?php

namespace App\Services;

use App\Repositories\MetatagRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;
use App\Traits\Services\MergeNewDataTrait;

class MetatagService
{
    use AdminPageTrait, CreateUpdateSlugTrait, MergeNewDataTrait;

    public function __construct(MetatagRepository $metatagRepo)
    {
        $this->baseRepo = $metatagRepo;
    }
}