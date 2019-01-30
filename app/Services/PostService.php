<?php

namespace App\Services;

use App\Repositories\PostRepository;

class PostService
{
	protected $postRepo;

	public function __construct(PostRepository $postRepo)
	{
		$this->postRepo = $postRepo;
	}

	public function getPaginated($path)
	{
		$categories = $this->postRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}
}