<?php

namespace App\Services;

use App\Repositories\PageCommentRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateUserTrait;
use App\Traits\MergeNewDataTrait;

class PageCommentService
{
    use AdminPageTrait, CreateUpdateUserTrait, MergeNewDataTrait;

    public function __construct(PageCommentRepository $pageCommentRepo)
    {
        $this->baseRepo = $pageCommentRepo;
    }
}