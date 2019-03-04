<?php

namespace App\Traits\Services;

trait MergeNewDataTrait
{
    public function mergeNewData(array $data, $id) {

        return $this->baseRepo->mergeNewData($data, $id);
    }
}