<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

use App\Interfaces\RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByIdOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getByParam(array $where, array $with = [], array $orderBy = [], $notId = false)
    {
        $model = $this->model->where($where);

        if (! empty($notId)) {
            $model = $model->where('id', '<>', $notId);
        }

        if (! empty($with)) {
            $model = $model->with($with);
        }

        if (! empty($orderBy)) {
            foreach ($orderBy as $column => $sort) {
                $model = $model->orderBy($column, $sort);
            }
        }

        return $model->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $record = $this->model->find($id);

        if (empty($record)) {
            return false;
        }

        $record->update($data);

        return $record;
    }

    public function mergeNewData(array $newData, $id)
    {

        $record = $this->model->find($id);

        if (empty($record)) {
            return false;
        }

        $data = $record->toArray();

        unset($data['id']);

        return array_merge($data, $newData);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getPaginated($path, $with = false, $count, array $where = [], array $orderBy = [])
    {
        $model = $this->model;

        if (! empty($with)) {
            $model = $model->with($with);
        }

        if (! empty($where)) {
            $model = $model->where($where);
        }

        if (! empty($orderBy)) {
            foreach ($orderBy as $column => $sort) {
                $model = $model->orderBy($column, $sort);
            }
        }

        return $model->paginate($count)->setPath($path);
    }

    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

	public function getCount(array $where=[])
	{
		if (!empty($where)) {
			return DB::table($this->model->getTable())->where($where)->count();
		}

		return DB::table($this->model->getTable())->count();
	}
}