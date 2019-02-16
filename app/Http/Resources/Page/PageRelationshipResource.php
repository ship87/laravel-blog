<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\Resource;

class PageRelationshipResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'comments' => (new PagePageCommentsRelationshipResource($this->comments))->additional(['page' => $this]),
            'metatags' => (new PageMetatagsRelationshipResource($this->metatags))->additional(['page' => $this]),
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
