<?php

namespace App\Services;

use App\Repositories\PageCommentRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateUserTrait;
use App\Traits\Services\MergeNewDataTrait;

class PageCommentService
{
    use AdminPageTrait, CreateUpdateUserTrait, MergeNewDataTrait;

    public function __construct(PageCommentRepository $pageCommentRepo)
    {
        $this->baseRepo = $pageCommentRepo;
    }
}