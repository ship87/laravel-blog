<?php

namespace App\Traits\Services;

trait AdminPageTrait
{
    protected $baseRepo;

    public function getById($id)
    {
        return $this->baseRepo->getById($id);
    }

    public function getByIdOrFail($id)
    {
        return $this->baseRepo->getByIdOrFail($id);
    }

    public function getAll()
    {
        return $this->baseRepo->getAll();
    }

    public function getPaginated($path, $with = false, array $where = [], array $orderBy = [])
    {
        return $this->baseRepo->getPaginated($path, $with, config('app.admin_pagination'), $where, $orderBy);
    }

    public function destroy(int $id)
    {
        return $this->baseRepo->destroy($id);
    }

	public function getCount(array $where=[]) {

    	return $this->baseRepo->getCount($where);
	}
}