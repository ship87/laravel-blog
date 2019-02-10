<?php

namespace App\Traits;

trait PreviousPageTrait
{
    public $previousUrl;

    protected function filterPreviousPage()
    {
        $this->previousUrl = $this->request->get('url_previous');

        if (empty($this->previousUrl)) {
            return false;
        }

        $this->request->remove('url_previous');

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