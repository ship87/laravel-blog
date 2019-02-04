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

    public function show($id)
    {
        $result = $this->userRepo->show($id);

        return $result;
    }

	public function getPaginated($path)
	{
		$categories = $this->userRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}

	public function create(array $data)
	{
		$result = $this->userRepo->create($data);

		return $result;
	}

	public function destroy(int $id)
	{
		$result = $this->userRepo->destroy($id);

		return $result;
	}
}