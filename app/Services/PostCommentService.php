<?php

namespace App\Services;

use App\Repositories\PostCommentRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateUserTrait;
use App\Traits\Services\MergeNewDataTrait;

class PostCommentService
{
    use AdminPageTrait, CreateUpdateUserTrait, MergeNewDataTrait;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->baseRepo = $postCommentRepo;
    }
}