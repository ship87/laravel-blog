<?php

namespace App\Traits;

trait MergeNewDataTrait
{
    public function mergeNewData(array $data, $id) {

        return $this->baseRepo->mergeNewData($data, $id);
    }
}