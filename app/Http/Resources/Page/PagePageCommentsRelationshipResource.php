<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\PageComment\PageCommentIdentifierResource;

class PagePageCommentsRelationshipResource extends ResourceCollection
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
            'data' => PageCommentIdentifierResource::collection($this->collection),
            'links' => [
                'self' => route('pages.relationships.page-comments', ['page' => $page->id]),
                'related' => route('pages.page-comments', ['page' => $page->id]),
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
