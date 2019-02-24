<?php

namespace App\Services;

use App\Repositories\PostCommentRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateUserTrait;
use App\Traits\MergeNewDataTrait;

class PostCommentService
{
    use AdminPageTrait, CreateUpdateUserTrait, MergeNewDataTrait;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->baseRepo = $postCommentRepo;
    }
}