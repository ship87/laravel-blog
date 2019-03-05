<?php

namespace App\Policies;

class PostCommentPolicy extends Policy
{
    protected $modelPermission = 'post-comment';
}
