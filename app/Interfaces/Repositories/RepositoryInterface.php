<?php

namespace App\Interfaces\Repositories;

interface RepositoryInterface
{
    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function getOne(array $where);

    public function getAll();

    public function getModel();

    public function setModel($model);
}