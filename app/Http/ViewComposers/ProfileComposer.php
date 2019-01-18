<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\CategoryRepository;

class ProfileComposer
{
	protected $categoryRepo;

	public function __construct(CategoryRepository $categoryRepository)
	{
		$this->categoryRepo = $categoryRepository;
	}

	public function compose(View $view)
	{
		$view->with('categories', '3');
	}
}