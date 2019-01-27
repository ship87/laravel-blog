<?php

namespace App\Repositories;

use App\Models\PostComment;

class PostCommentRepository extends Repository
{
	public function __construct(PostComment $model)
	{
		$this->model = $model;
	}
}