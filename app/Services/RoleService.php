<?php

namespace App\Services;

use App\Repositories\RoleRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;

class RoleService
{
    use AdminPageTrait, CreateUpdateSlugTrait;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->baseRepo = $roleRepo;
    }

}