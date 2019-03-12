<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Services\PermissionService;

class Policy
{
    use HandlesAuthorization;

    protected $permissionService;

    /**
     * Policy constructor.
     *
     * @param \App\Services\PermissionService $permissionService
     */
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Determine whether the user can view the models.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function index(User $user)
    {
        return $this->crudCheck($user, 'view');
    }

    /**
     * Determine whether the user can create the model.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $this->crudCheck($user, 'create');
    }

    /**
     * Determine whether the user can create the model.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function store(User $user)
    {
        return $this->crudCheck($user, 'create');
    }

    /**
     * Determine whether the user can edit the model.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $this->crudCheck($user, 'update');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $this->crudCheck($user, 'update');
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function destroy(User $user)
    {
        return $this->crudCheck($user, 'delete');
    }

    /**
     * Determine whether the user can make CRUD operations.
     *
     * @param \App\Models\User $user
     * @param $permission
     * @return bool
     */
    public function crudCheck(User $user, $permission)
    {
        $check = true;

        if ($user->role_id != 1) {
            $check = $this->permissionService->getPermissionBySlugRoleId([
                $this->modelPermission.'-'.$permission,
            ], $user->role_id);
        }

        return ! empty($check) ? true : false;
    }
}
