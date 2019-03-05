<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

use App\Repositories\PermissionRoleRepository;
use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;

class PermissionService
{
    use AdminPageTrait, CreateUpdateSlugTrait;

    protected $permissionRoleRepository;

    public function __construct(PermissionRepository $permissionRepo, PermissionRoleRepository $permissionRoleRepository)
    {
        $this->baseRepo = $permissionRepo;
        $this->permissionRoleRepository = $permissionRoleRepository;
    }

	public function getAllTitleId($excludePermission = false)
	{
		return $this->baseRepo->getAllTitleId($excludePermission);
	}

	public function getId($permissions)
	{
		return $this->baseRepo->getId($permissions);
	}

	public function getPermissionBySlugRoleId(array $slug, $roleId){

    	return $this->baseRepo->getPermissionBySlugRoleId($slug, $roleId);
	}
}