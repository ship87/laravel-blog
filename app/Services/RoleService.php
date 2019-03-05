<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\PermissionRoleRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;

class RoleService
{
    use AdminPageTrait, CreateUpdateSlugTrait;

    protected  $permissionRoleRepo;

    public function __construct(RoleRepository $roleRepo, PermissionRoleRepository $permissionRoleRepo)
    {
        $this->baseRepo = $roleRepo;
        $this->permissionRoleRepo = $permissionRoleRepo;
    }

	public function update(array $data, array $relationData, $id)
	{
		$role = $this->baseRepo->update($data, $id);

		if (! $role) {
			return false;
		}

		$this->saveRelationData($role, $relationData);

		return $role;
	}

	public function create(array $data, array $relationData)
	{

		$role = $this->baseRepo->create($data);

		if (! $role) {
			return false;
		}

		$this->saveRelationData($role, $relationData);

		return $role;
	}

	private function saveRelationData($role, array $relationData)
	{

		if (! empty($relationData['permissions'])) {
			$this->permissionRoleRepo->saveMany($role, array_values($relationData['permissions']));
		}

	}

}