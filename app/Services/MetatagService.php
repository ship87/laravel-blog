<?php

namespace App\Services;

use App\Repositories\MetatagRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateSlugTrait;

class MetatagService
{
    use AdminPageTrait;

    use CreateUpdateSlugTrait;

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