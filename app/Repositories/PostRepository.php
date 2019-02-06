<?php

namespace App\Repositories;

use App\Models\Post;

class PostRepository extends Repository
{
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getByParam(array $where = [])
    {
        return $this->model->with([
            'comments',
            'metatags',
            'tags',
            'categories',
            'createdUser',
            'updatedUser',
        ])->where($where)->first();
    }

    public function getCategoryPostsPaginated($path, $count, $category)
    {
        return $this->model->whereHas('categories', function ($q) use ($category) {
            $q->where('slug', $category);
        })->paginate($count)->setPath($path);
    }

    public function getArchivePostsPaginated($path, $count, $year, $month = false, $day = false)
    {
        $startTime = '00:00:00';
        $endTime = '23:59:59';

        $startDate = $year.'-01-01 '.$startTime;
        $endDate = $year.'-12-31 '.$endTime;

        if ($day && $month) {

            $startDate = $year.'-'.$month.'-'.$day.' '.$startTime;
            $endDate = $year.'-'.$month.'-'.$day.' '.$endTime;
        } elseif ($month) {

            $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $startDate = $year.'-'.$month.'-01 '.$startTime;
            $endDate = $year.'-'.$month.'-'.$daysInMonth.' '.$endTime;
        }

        return $this->model->whereBetween('created_at', [$startDate, $endDate])->paginate($count)->setPath($path);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }
}