<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

	/**
	 * Determine whether the user can view the post.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Post  $post
	 * @return mixed
	 */
	public function index(User $user)
	{

		return $user->id == 1;
	}

    /**
     * Determine whether the user can view the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function view(User $user)
    {
		return $user->id == 1;
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
		return $user->id == 1;
    }

	/**
	 * Determine whether the user can update the category.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Category  $category
	 * @return mixed
	 */
	public function store(User $user)
	{
		return $user->id == 1;
	}

	/**
	 * Determine whether the user can update the category.
	 *
	 * @param  \App\Models\User  $user
	 * @param  \App\Models\Category  $category
	 * @return mixed
	 */
	public function edit(User $user)
	{
		return $user->id == 1;
	}

    /**
     * Determine whether the user can update the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function update(User $user)
    {
		return $user->id == 1;
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Category  $category
     * @return mixed
     */
    public function destroy(User $user)
    {
		return $user->id == 1;
    }
}
