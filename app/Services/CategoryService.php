<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService
{
	protected $categoryRepo;

	public function __construct(CategoryRepository $categoryRepo)
	{
		$this->categoryRepo = $categoryRepo;
	}

	public function show($id)
	{
		$result = $this->categoryRepo->show($id);

		return $result;
	}

	public function getPaginated($path)
	{
		$categories = $this->categoryRepo->getPaginated($path, config('app.admin_pagination'));

		return $categories;
	}

	public function create(array $data)
	{
		$result = $this->categoryRepo->create($data);

		return $result;
	}

	public function destroy(int $id)
	{
		$result = $this->categoryRepo->destroy($id);

		return $result;
	}
}