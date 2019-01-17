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
        ])->where($where)->get();
    }

    public function getPostsWithPaginate($path, $count, array $where = [])
    {
        return $this->model->where($where)->paginate($count)->setPath($path);
    }
}