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

    public function getByParam(array $where)
    {
        return $this->model->where($where)->first();
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

    public function getPaginated($path, $count)
    {
        return $this->model->paginate($count)->setPath($path);
    }
}