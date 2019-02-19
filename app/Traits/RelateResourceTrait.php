<?php

namespace App\Traits;

trait RelateResourceTrait
{
    protected $include = [];

    public function __construct($resource, array $include = [])
    {
        $this->resource = $resource;

        if ($include) {
            $this->include = $include;
        }
    }

    protected function includedResource(array $include = [], $page)
    {
        if (empty($this->include)) {
            return $page;
        }

        $included = false;

        foreach ($include as $relatedResource => $relatedResourceClass) {

            $resource = $relatedResourceClass::collection($this->{$relatedResource});

            if (! $included) {
                $included = collect($resource);
            } else {
                $included = $included->merge($resource);
            }
        }

        if (! $included) {
            return $page;
        }

        return array_merge($page, [
            'included' => $included,
        ]);
    }
}