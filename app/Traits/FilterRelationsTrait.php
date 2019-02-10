<?php

namespace App\Traits;

trait FilterRelationsTrait
{
    public $relationData;

    protected function filterRelations()
    {
        if (empty($this->filterRelations) || ! is_array($this->filterRelations)) {
            return false;
        }

        $this->relationData = $this->only($this->filterRelations);

        foreach ($this->filterRelations as $relation) {
            $this->request->remove($relation);
        }

        return true;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        $this->filterPreviousPage();

        return parent::validationData();
    }
}