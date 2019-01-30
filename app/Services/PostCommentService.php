<?php

namespace App\Services;

use App\Repositories\PostCommentRepository;

class PostCommentService
{
    protected $postCommentRepo;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->postCommentRepo = $postCommentRepo;
    }

    public function getPaginated($path)
    {
        $postComments = $this->postCommentRepo->getPaginated($path, config('app.admin_pagination'));

        return $postComments;
    }
}