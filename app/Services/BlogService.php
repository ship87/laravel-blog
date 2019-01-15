<?php

namespace App\Services;

use App\Repositories\PostRepository;

class BlogService
{
    protected $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    public function getPost($id, $slug)
    {
        $post = $this->postRepo->getOne([
            'id' => $id,
            'slug' => $slug,
        ]);

        return $post;
    }
}