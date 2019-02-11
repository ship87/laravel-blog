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

    public function getByParam(array $where = [])
    {
        return $this->model->with(['comments', 'metatags', 'createdUser', 'updatedUser'])->where($where)->first();
    }

    public function getUrl($slug)
    {
        return DB::table($this->model->getTable())->where('slug', '=', $slug)->first();
    }

    public function getAllTitleId()
    {
        return $this->model->pluck('title','id')->all();
    }
}