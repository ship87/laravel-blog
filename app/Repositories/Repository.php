<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

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

    public function getByParam(array $where, array $with = [], array $orderBy = [])
    {
        $model = $this->model->where($where);

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

        $record->update($data);

        return $record;
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
}