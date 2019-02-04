<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function create(array $data);

    public function update(array $data, $id);

    public function destroy($id);

    public function getOne(array $where);

    public function getAll();

    public function getModel();

    public function setModel($model);
}