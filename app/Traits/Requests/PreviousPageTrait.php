<?php

namespace App\Traits\Requests;

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
}