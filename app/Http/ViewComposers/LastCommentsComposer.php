<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Services\PostCommentService;

class LastCommentsComposer
{
    protected $postCommentService;

    public function __construct(PostCommentService $postCommentService)
    {
        $this->postCommentService = $postCommentService;
    }

    public function compose(View $view)
    {
        $view->with('lastCommentsWidget', $this->postCommentService->getWithUrl(5));
    }
}