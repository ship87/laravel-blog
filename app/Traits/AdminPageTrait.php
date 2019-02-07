<?php

namespace App\Traits;

trait AdminPageTrait
{
    protected $baseRepo;

    public function getById($id)
    {
        return $this->baseRepo->getById($id);
    }

    public function getAll()
    {
        return $this->baseRepo->getAll();
    }

	public function getPaginated($path)
	{
		return $this->baseRepo->getPaginated($path, config('app.admin_pagination'));
	}

	public function destroy(int $id)
	{
		return $this->baseRepo->destroy($id);
	}
}