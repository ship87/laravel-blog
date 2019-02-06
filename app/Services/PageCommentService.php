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

    public function show($id)
    {
        $result = $this->pageCommentRepo->show($id);

        return $result;
    }

    public function getPaginated($path)
    {
        $categories = $this->pageCommentRepo->getPaginated($path, config('app.admin_pagination'));

        return $categories;
    }

    public function create(array $data, $auth)
    {
        $data['created_user_id'] = $data['updated_user_id'] = $auth->id;

        $result = $this->pageCommentRepo->create($data);

        return $result;
    }

    public function update(array $data, $id, $auth)
    {
        $data['updated_user_id'] = $auth->id;

        $result = $this->pageCommentRepo->update($data, $id);

        return $result;
    }

    public function destroy(int $id)
    {
        $result = $this->pageCommentRepo->destroy($id);

        return $result;
    }
}