<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PostComment;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostCommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the postComment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return mixed
     */
    public function view(User $user, PostComment $postComment)
    {
        //
    }

    /**
     * Determine whether the user can create postComments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the postComment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return mixed
     */
    public function update(User $user, PostComment $postComment)
    {
        //
    }

    /**
     * Determine whether the user can delete the postComment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PostComment  $postComment
     * @return mixed
     */
    public function delete(User $user, PostComment $postComment)
    {
        //
    }
}
