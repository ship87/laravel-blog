<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
	protected $userRepo;

	public function __construct(UserRepository $userRepo)
	{
		$this->userRepo = $userRepo;
	}

	public function getPaginated($path)
	{
		$categories = $this->userRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}
}