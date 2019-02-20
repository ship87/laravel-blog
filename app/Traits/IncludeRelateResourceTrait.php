<?php

namespace App\Traits;

trait IncludeRelateResourceTrait
{
    public function includeRelatedResources($include)
    {
        if (empty($include)) {
            return false;
        }

        $include = explode(',', $include);
        $relatedResourcesPrepare = array_keys($this->relatedResources);

        foreach ($relatedResourcesPrepare as $key => $value) {
            $relatedResources[$value] = strtolower($value);
        }

        foreach ($include as $relateResource) {

            $search = array_search($relateResource, $relatedResources);

            if ($search) {

                $with[$search] = $this->relatedResources[$search];
            }
        }

        if (empty($with)) {
            return false;
        }

        return [
            'with' => array_keys($with),
            'relatedResources' => $with,
        ];
    }
}