<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Repositories\CommentRepository;

class LastCommentsComposer
{
    protected $commentRepo;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepo = $commentRepository;
    }

    public function compose(View $view)
    {
        $view->with('lastComments', $this->commentRepo->getAll());
    }
}