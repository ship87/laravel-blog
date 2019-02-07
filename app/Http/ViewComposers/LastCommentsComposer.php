<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\PostCommentRepository;

class LastCommentsComposer
{
    protected $postCommentRepo;

    public function __construct(PostCommentRepository $postCommentRepository)
    {
        $this->postCommentRepo = $postCommentRepository;
    }

    public function compose(View $view)
    {
       // $view->with('lastCommentsWidget', $this->postCommentRepo->getAll());
    }
}