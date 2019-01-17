<?php

namespace App\Services;

use App\Repositories\PageRepository;

class PageService
{
	protected $pageRepo;

	public function __construct(PageRepository $pageRepo)
	{
		$this->pageRepo = $pageRepo;
	}

	public function getPage($slug)
	{
		$page = $this->pageRepo->getPage([
			'slug' => $slug
		]);

		dd($page);

		return $page;
	}
}