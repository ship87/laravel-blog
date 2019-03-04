<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Metatag;
use Illuminate\Auth\Access\HandlesAuthorization;

class MetatagPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the metatag.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Metatag  $metatag
     * @return mixed
     */
    public function view(User $user, Metatag $metatag)
    {
        //
    }

    /**
     * Determine whether the user can create metatags.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the metatag.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Metatag  $metatag
     * @return mixed
     */
    public function update(User $user, Metatag $metatag)
    {
        //
    }

    /**
     * Determine whether the user can delete the metatag.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Metatag  $metatag
     * @return mixed
     */
    public function delete(User $user, Metatag $metatag)
    {
        //
    }
}
