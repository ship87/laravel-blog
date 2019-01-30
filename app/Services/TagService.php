<?php

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
	protected $tagRepo;

	public function __construct(TagRepository $tagRepo)
	{
		$this->tagRepo = $tagRepo;
	}

	public function getPaginated($path)
	{
		$categories = $this->tagRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}
}