<?php

namespace App\Traits\Resources;

use Illuminate\Support\Collection;

trait RelateResourceTrait
{
    protected $include = [];

    public function __construct($resource, $include = false)
    {
        $this->resource = $resource;

        if ($include) {
            $this->include = $include;
        }
    }

    protected function includedResource(array $include, $page)
    {
        $included = false;

        foreach ($include as $relatedResource => $relatedResourceClass) {

            $data = $this->{$relatedResource};

            if ($data instanceof Collection) {
                $resource = $relatedResourceClass::collection($data);
            } else {
                $resource = $relatedResourceClass::collection((new Collection())->push($data));
            }

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