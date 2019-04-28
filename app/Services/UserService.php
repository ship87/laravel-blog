<?php

namespace App\Services;

use App\Repositories\UserRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateTrait;
use App\Traits\Services\MergeNewDataTrait;

class UserService
{
    use AdminPageTrait, CreateUpdateTrait, MergeNewDataTrait;

    public function __construct(UserRepository $userRepo)
    {
        $this->baseRepo = $userRepo;
    }
}