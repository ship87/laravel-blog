<?php

namespace App\Services;

use App\Repositories\MetatagRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;

class MetatagService
{
    use AdminPageTrait, CreateUpdateSlugTrait;

    public function __construct(MetatagRepository $metatagRepo)
    {
        $this->baseRepo = $metatagRepo;
    }

    public function getAllTitleId($excludeMetatag = false)
    {
        return $this->baseRepo->getAllTitleId($excludeMetatag);
    }

    public function getId($metatags)
    {
        return $this->baseRepo->getId($metatags);
    }
}