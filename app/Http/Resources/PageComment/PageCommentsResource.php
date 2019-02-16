<?php

namespace App\Http\Resources\PageComment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PageCommentsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => PageCommentResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'links'    => [
                'self' => route('page-comments.index'),
            ],
        ];
    }
}
