<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\MetatagRepository;

use App\Traits\AdminPageTrait;
use App\Traits\ClientPageTrait;
use App\Traits\CreateUpdateUserTrait;

class PostService
{
    use AdminPageTrait;

    use ClientPageTrait;

	use CreateUpdateUserTrait;

    public function __construct(PostRepository $postRepo, MetatagRepository $metatagRepo)
    {
        $this->baseRepo = $postRepo;
        $this->metatagRepo = $metatagRepo;
    }

}