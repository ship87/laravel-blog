<?php

namespace App\Traits\Services;

trait FilterDataTrait
{
    public function filterData($data, $where = [])
    {
        if (empty($data['filter'])) {
            return $where;
        }

        $addWhere = [];

        foreach ($data['filter'] as $isFilter => $filterData) {
            if (in_array($isFilter, $this->whereData)) {
                $addWhere[$isFilter] = $filterData;
            }
        }

        if (empty($addWhere)) {
            return $where;
        }

        return array_merge($where, $addWhere);
    }
}