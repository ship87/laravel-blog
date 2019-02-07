<?php

namespace App\Services;

use App\Repositories\TagRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateTrait;

class TagService
{
	use AdminPageTrait;

	use CreateUpdateTrait;

    public function __construct(TagRepository $tagRepo)
    {
        $this->baseRepo = $tagRepo;
    }

	public function getAllNames()
	{
		return $this->baseRepo->getAllNames();
	}
}