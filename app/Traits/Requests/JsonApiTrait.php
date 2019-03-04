<?php

namespace App\Traits\Requests;

trait JsonApiTrait
{
    protected $acceptJsonApi = 'application/vnd.api+json';

    protected function isJsonApiRequest()
    {
        $accept = request()->getAcceptableContentTypes();
        $checkAccept = array_shift($accept);

        if ($checkAccept == $this->acceptJsonApi) {

            return $checkAccept;
        }

        return false;
    }

    protected function validationDataJsonApiRequest($type)
    {
        $accept = $this->isJsonApiRequest();

        if ($accept && $accept== $this->acceptJsonApi) {

            if ($this->get('type') == $type) {

                $attributes = request()->input('attributes');

                foreach ($attributes as $attribute => $value) {
                    $this->{$attribute} = $value;
                }

                return $this->get('attributes');
            }

            return [];
        }

        return null;
    }
}