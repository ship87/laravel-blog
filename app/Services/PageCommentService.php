<?php

namespace App\Services;

use App\Repositories\PageCommentRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateUserTrait;

class PageCommentService
{
	use AdminPageTrait;

	use CreateUpdateUserTrait;

    public function __construct(PageCommentRepository $pageCommentRepo)
    {
        $this->baseRepo = $pageCommentRepo;
    }
}