<?php

namespace App\Services;

use App\Repositories\UserRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateTrait;

class UserService
{
    use AdminPageTrait,CreateUpdateTrait;

    public function __construct(UserRepository $userRepo)
    {
        $this->baseRepo = $userRepo;
    }
}