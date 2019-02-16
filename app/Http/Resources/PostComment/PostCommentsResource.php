<?php

namespace App\Http\Resources\PostComment;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCommentsResource extends ResourceCollection
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
            'data' => PostCommentResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('post-comments.index'),
            ],
        ];
    }
}
