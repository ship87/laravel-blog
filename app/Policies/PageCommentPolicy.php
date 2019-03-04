<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PageComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PageCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the pageComment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageComment  $pageComment
     * @return mixed
     */
    public function view(User $user, PageComment $pageComment)
    {
        //
    }

    /**
     * Determine whether the user can create pageComments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the pageComment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageComment  $pageComment
     * @return mixed
     */
    public function update(User $user, PageComment $pageComment)
    {
        //
    }

    /**
     * Determine whether the user can delete the pageComment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PageComment  $pageComment
     * @return mixed
     */
    public function delete(User $user, PageComment $pageComment)
    {
        //
    }
}
