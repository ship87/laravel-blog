<?php

namespace App\Services;

use App\Repositories\TagRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;
use App\Traits\Services\MergeNewDataTrait;

class TagService
{
    use AdminPageTrait, CreateUpdateSlugTrait, MergeNewDataTrait;

    public function __construct(TagRepository $tagRepo)
    {
        $this->baseRepo = $tagRepo;
    }

    public function getAllNameId()
    {
        return $this->baseRepo->getAllNameId();
    }

    public function getId($tags)
    {
        return $this->baseRepo->getId($tags);
    }
}