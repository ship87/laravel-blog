<?php

namespace App\Repositories;

use App\Models\Role;

class PermissionRoleRepository extends Repository
{
    protected $permissionRepo;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepo = $permissionRepository;
    }

    public function saveMany(Role $role, array $permissions)
    {
        return $role->permissions()->sync($permissions);
    }
}