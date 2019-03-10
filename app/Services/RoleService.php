<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use App\Repositories\PermissionRoleRepository;
use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateSlugTrait;
use App\Traits\Services\MergeNewDataTrait;

class RoleService
{
    use AdminPageTrait, CreateUpdateSlugTrait, MergeNewDataTrait;

    protected $permissionRoleRepo;

    public function __construct(RoleRepository $roleRepo, PermissionRoleRepository $permissionRoleRepo)
    {
        $this->baseRepo = $roleRepo;
        $this->permissionRoleRepo = $permissionRoleRepo;
    }

    public function update(array $data, array $relationData, $id)
    {
        if (! empty($data['title'])) {
            $data['slug'] = $this->checkSlug(empty($data['slug']) ? false : $data['slug'], $data['title'], $id);
        }

        $role = $this->baseRepo->update($data, $id);

        if (! $role) {
            return false;
        }

        $this->saveRelationData($role, $relationData);

        return $role;
    }

    public function create(array $data, array $relationData)
    {
        $data['slug'] = $this->checkSlug($data['slug'], $data['title']);

        $role = $this->baseRepo->create($data);

        if (! $role) {
            return false;
        }

        $this->saveRelationData($role, $relationData);

        return $role;
    }

    private function saveRelationData($role, array $relationData)
    {

        $permissions = [];
        if (! empty($relationData['permissions']) && is_array($relationData['permissions'])) {
            $permissions = array_values($relationData['permissions']);
        }

        $this->permissionRoleRepo->saveMany($role, $permissions);
    }

    public function getAllTitleId($excludeRole = false)
    {
        return $this->baseRepo->getAllTitleId($excludeRole);
    }

    public function getId($roles)
    {
        return $this->baseRepo->getId($roles);
    }
}