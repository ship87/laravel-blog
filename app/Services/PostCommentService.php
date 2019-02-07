<?php

namespace App\Services;

use App\Repositories\PostCommentRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateUserTrait;

class PostCommentService
{
	use AdminPageTrait;

	use CreateUpdateUserTrait;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->baseRepo = $postCommentRepo;
    }
}