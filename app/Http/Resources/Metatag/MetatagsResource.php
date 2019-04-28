<?php

namespace App\Http\Resources\Metatag;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MetatagsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => MetatagResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('metatags.index'),
            ],
        ];
    }
}
