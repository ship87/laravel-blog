<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

use App\Models\Page;

class PageRepository extends Repository
{
    public function __construct(Page $model)
    {
        $this->model = $model;
    }

    public function getPage(array $where = [])
    {
        return $this->model->with(['comments', 'metatags', 'createdUser', 'updatedUser'])->where($where)->first();
    }

    public function getPageUrl($slug)
    {
        return DB::table($this->model->getTable())->where('slug', '=', $slug)->first();
    }
}