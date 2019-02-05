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

	public function getPost($id)
	{
		$post = $this->postRepo->getPost([
			'id' => $id
		]);

		return $post;
	}

    public function getPaginated($path)
    {
        $categories = $this->postRepo->getPaginated($path, config('app.admin_pagination'));

        return $categories;
    }

    public function create(array $data, $auth)
    {
        $data['created_user_id'] = $data['updated_user_id'] = $auth->id;

        $result = $this->postRepo->create($data);

        return $result;
    }

	public function update(array $data, $id, $auth)
	{
		$data['updated_user_id'] = $auth->id;

		$result = $this->postRepo->update($data, $id);

		return $result;
	}

    public function destroy(int $id)
    {
        $result = $this->postRepo->destroy($id);

        return $result;
    }
}