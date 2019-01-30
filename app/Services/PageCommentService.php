<?php

namespace App\Services;

use App\Repositories\PageCommentRepository;

class PageCommentService
{
	protected $pageCommentRepo;

	public function __construct(PageCommentRepository $pageCommentRepo)
	{
		$this->pageCommentRepo = $pageCommentRepo;
	}

	public function getPaginated($path)
	{
		$categories = $this->pageCommentRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}
}