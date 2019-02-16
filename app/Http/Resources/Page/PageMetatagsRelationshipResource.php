<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Metatag\MetatagIdentifierResource;

class PageMetatagsRelationshipResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $page = $this->additional['page'];

        return [
            'data' => MetatagIdentifierResource::collection($this->collection),
            'links' => [
                'self' => route('pages.relationships.metatags', ['page' => $page->id]),
                'related' => route('pages.metatags', ['page' => $page->id]),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('pages.index'),
            ],
        ];
    }
}
