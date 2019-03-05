<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\User;
use App\Services\PermissionService;

class Policy
{
    use HandlesAuthorization;

    protected $superUserPermission = 'allow-all-actions';

    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Post $post
     * @return mixed
     */
    public function index(User $user)
    {
        return $this->crudCheck($user,'view');
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->crudCheck($user,'create');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Category $category
     * @return mixed
     */
    public function store(User $user)
    {
        return $this->crudCheck($user,'create');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Category $category
     * @return mixed
     */
    public function edit(User $user)
    {
        return $this->crudCheck($user,'update');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Category $category
     * @return mixed
     */
    public function update(User $user)
    {
        return $this->crudCheck($user,'update');
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Category $category
     * @return mixed
     */
    public function destroy(User $user)
    {
        return $this->crudCheck($user,'delete');
    }

    public function crudCheck(User $user, $permission){

        $check = $this->permissionService->getPermissionBySlugRoleId([
            $this->superUserPermission,
            $this->modelPermission.'-'.$permission,
        ], $user->role_id);

        return $check ?? abort('403', 'Unauthorized action.');
    }
}
