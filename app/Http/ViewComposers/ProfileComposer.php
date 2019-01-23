<?php

namespace App\Http\ViewComposers;

use App\Repositories\CommentRepository;
use Illuminate\View\View;
use App\Repositories\CategoryRepository;

class ProfileComposer
{
    protected $categoryRepo;

    protected $commentRepo;

    public function __construct(CategoryRepository $categoryRepository, CommentRepository $commentRepository)
    {
        $this->categoryRepo = $categoryRepository;
        $this->commentRepo = $commentRepository;
    }

    public function compose(View $view)
    {
        $view->with('categories', $this->categoryRepo->getAll());

        $view->with('comments', $this->commentRepo->getAll());
    }
}