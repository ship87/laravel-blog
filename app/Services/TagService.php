<?php

namespace App\Services;

use App\Repositories\TagRepository;

use App\Traits\AdminPageTrait;
use App\Traits\CreateUpdateSlugTrait;
use App\Traits\CreateUpdateTrait;

class TagService
{
	use AdminPageTrait;

	use CreateUpdateSlugTrait;

    public function __construct(TagRepository $tagRepo)
    {
        $this->baseRepo = $tagRepo;
    }

	public function getAllNameId()
	{
		return $this->baseRepo->getAllNameId();
	}

	public function getId($tags)
	{
		return $this->baseRepo->getId($tags);
	}
}