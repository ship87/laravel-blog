<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends Repository
{
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getByParamWithAll(array $where)
    {
        return $this->model->with(['comments', 'metatags', 'createdUser', 'updatedUser'])->where($where)->first();
    }

    public function getUrl($slug)
    {
        return $this->model->where('slug', '=', $slug)->first();
    }

    public function getAllTitleId()
    {
        return $this->model->pluck('title','id')->all();
    }

	public function search(string $query = "")
	{
		return $this->model->where('content', 'like', "%{$query}%")
			->orWhere('title', 'like', "%{$query}%")
			->get();
	}

	public function getUrlByPage($page)
	{
		$url = '/' . $page->slug;
		$parentId = (int)$page->parent_id;

		while ($parentId > 0) {
			$parent = $this->getById($parentId);
			$url = '/' . $parent->slug . $url;
			$parentId = (int)$parent->parent_id;
		}

		return $url;
	}
}