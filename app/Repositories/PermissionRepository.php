<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends Repository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function getAllTitleId($excludePermission = false)
    {
        if ($excludePermission) {
            return $this->model->where('id', '!=', $excludePermission->id)->pluck('title', 'id')->all();
        } else {
            return $this->model->pluck('title', 'id')->all();
        }
    }

    public function getId($permissions)
    {
        return $permissions->pluck('id')->all();
    }

    public function getPermissionBySlugRoleId(array $slug, $roleId)
    {
        return $this->model->with('roles')->whereHas('roles', function ($q) use ($roleId) {
            $q->where('role_id', $roleId);
        })->whereIn('slug',$slug)->first();
    }
}