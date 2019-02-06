<?php

namespace App\Services;

use App\Repositories\TagRepository;
use App\Traits\AdminActions;

class TagService
{
    use AdminActions;

    public function __construct(TagRepository $tagRepo)
    {
        $this->baseRepo = $tagRepo;
    }
}