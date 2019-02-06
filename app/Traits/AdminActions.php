<?php

namespace App\Traits;

trait AdminActions
{
    protected $baseRepo;

    public function show($id)
    {
        return $this->baseRepo->show($id);
    }

    public function getPaginated($path)
    {
        return $this->baseRepo->getPaginated($path, config('app.admin_pagination'));
    }

    public function create(array $data)
    {
        return $this->baseRepo->create($data);
    }

    public function update(array $data, $id)
    {

        return $this->baseRepo->update($data, $id);
    }

    public function destroy(int $id)
    {
        return $this->baseRepo->destroy($id);
    }

    public function getAll()
    {
        return $this->baseRepo->getAll();
    }
}