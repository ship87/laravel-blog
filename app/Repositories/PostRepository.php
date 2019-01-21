<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends Repository
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getPost(array $where = [])
    {
        return $this->model->with([
            'comments',
            'metatags',
            'tags',
            'categories',
            'createdUser',
            'updatedUser',
        ])->where($where)->first();
    }

    public function getPostsPaginated($path, $count)
    {
        return $this->model->paginate($count)->setPath($path);
    }

	public function getCategoryPostsPaginated($path, $count,$category)
	{
		$this->model->setCategorySlug($category);

		return $this->model->with(['categoriesSelected'])->paginate($count)->setPath($path);
	}
}