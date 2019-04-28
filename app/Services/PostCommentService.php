<?php

namespace App\Services;

use App\Repositories\PostCommentRepository;

use App\Traits\Services\AdminPageTrait;
use App\Traits\Services\CreateUpdateUserTrait;
use App\Traits\Services\MergeNewDataTrait;

class PostCommentService
{
    use AdminPageTrait, CreateUpdateUserTrait, MergeNewDataTrait;

    public function __construct(PostCommentRepository $postCommentRepo)
    {
        $this->baseRepo = $postCommentRepo;
    }

    public function getWithUrl($count = false)
    {
        $comments = $this->baseRepo->getWithUrl($count);

        foreach ($comments as $key => $comment) {
            $comments[$key]->url = url(config('app.url_blog').'/'.$comment->id.'/'.$comment->post_slug);
        }

        return $comments;
    }
}