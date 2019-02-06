<?php

namespace App\Services;

use App\Repositories\PostRepository;
use App\Repositories\MetatagRepository;
use App\Traits\ClientActions;

class PostService
{
    use ClientActions;

    public function __construct(PostRepository $postRepo, MetatagRepository $metatagRepo)
    {
        $this->baseRepo = $postRepo;
        $this->metatagRepo = $metatagRepo;
    }

    public function getPaginated($path)
    {
        return $this->baseRepo->getPaginated($path, config('app.admin_pagination'));
    }
}