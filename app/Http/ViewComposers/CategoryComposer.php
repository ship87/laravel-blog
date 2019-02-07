<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

use App\Helpers\BuildTree;
use App\Repositories\CategoryRepository;

class CategoryComposer
{
	protected $categoryRepo;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepo = $categoryRepository;
	}

	public function compose(View $view)
	{
		//$buildTree=new BuildTree($this->categoryRepo->getAll());

		//$view->with('categoriesWidget', $buildTree->getTree());
	}

}