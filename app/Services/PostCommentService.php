<?php

namespace App\Services;

use App\Repositories\PostCommentRepository;

class PostCommentService
{
    protected $postCommentRepo;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->postCommentRepo = $postCommentRepo;
    }

    public function show($id)
    {
        $result = $this->postCommentRepo->show($id);

        return $result;
    }

    public function getPaginated($path)
    {
        $postComments = $this->postCommentRepo->getPaginated($path, config('app.admin_pagination'));

        return $postComments;
    }

	public function create(array $data)
	{
		$result = $this->postCommentRepo->create($data);

		return $result;
	}

	public function update(array $data, $id)
	{
		$result = $this->postCommentRepo->update($data, $id);

		return $result;
	}

	public function destroy(int $id)
	{
		$result = $this->postCommentRepo->destroy($id);

		return $result;
	}
}