<?php

namespace App\Traits\Services;

trait IncludeRelateResourceTrait
{
    public function includeRelatedResources($include)
    {
        if (empty($include)) {
            return false;
        }

        $include = explode(',', $include);
        $relatedResources = array_keys($this->relatedResources);

        foreach ($include as $relateResource) {

            $search = array_search($relateResource, $relatedResources);

            if ($search) {

                $with[$relateResource] = $this->relatedResources[$relateResource];
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