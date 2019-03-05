<?php

namespace App\Services;

use App\Repositories\ActionRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;

class ActionService
{
    use AdminPageTrait, CreateUpdateSlugTrait;

    public function __construct(ActionRepository $actionRepo)
    {
        $this->baseRepo = $actionRepo;
    }

    public function getAllNameId()
    {
        return $this->baseRepo->getAllNameId();
    }

    public function getId($actions)
    {
        return $this->baseRepo->getId($actions);
    }
}