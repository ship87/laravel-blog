<?php

namespace App\Traits\Services;

trait SortDataTrait
{
    public function sortData($sort)
    {
        if (empty($sort)) {
            return [];
        }

        $columns = explode(',', $sort);
        $sortData = [];
        $columnsSortData = array_keys($this->sortData);

        foreach ($columns as $column) {
            if (in_array($column, $columnsSortData)) {
                $sortData[$column] = $this->sortData[$column];
            }
        }

        if (empty($sortData)) {
            return [];
        }

        return $sortData;
    }
}