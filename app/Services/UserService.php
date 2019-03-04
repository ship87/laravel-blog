<?php

namespace App\Services;

use App\Repositories\UserRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateTrait;

class UserService
{
    use AdminPageTrait,CreateUpdateTrait;

    public function __construct(UserRepository $userRepo)
    {
        $this->baseRepo = $userRepo;
    }
}