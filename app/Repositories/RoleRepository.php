<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

	public function getAllTitleId($excludeRole = false)
	{
		if ($excludeRole) {
			return $this->model->where('id', '!=', $excludeRole->id)->pluck('title', 'id')->all();
		} else {
			return $this->model->pluck('title', 'id')->all();
		}
	}

	public function getId($roles)
	{
		return $roles->pluck('id')->all();
	}
}