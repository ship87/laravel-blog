<?php

namespace App\Traits;

trait IncludeRelateResourceTrait
{
    public function includeData($include)
    {
        if (empty($include)) {
            return false;
        }

        $include = explode(',', $include);
        $relatedResources = array_keys($this->relatedResources);

        foreach ($include as $relateResource) {
            if (in_array($relateResource, $relatedResources)) {
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