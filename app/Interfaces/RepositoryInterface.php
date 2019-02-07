<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function getById($id);

    public function getByParam(array $where);

    public function getAll();

    public function getModel();

    public function setModel($model);
}