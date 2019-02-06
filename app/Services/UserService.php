<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Traits\AdminActions;

class UserService
{
    use AdminActions;

    public function __construct(UserRepository $userRepo)
    {
        $this->baseRepo = $userRepo;
    }
}