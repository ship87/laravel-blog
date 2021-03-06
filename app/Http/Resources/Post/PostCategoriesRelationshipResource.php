<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\Category\CategoryIdentifierResource;

class PostCategoriesRelationshipResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $post = $this->additional['post'];

        return [
            'data' => CategoryIdentifierResource::collection($this->collection),
            'links' => [
                'self' => route('posts.relationships.categories', ['post' => $post->id]),
                'related' => route('posts.categories', ['post' => $post->id]),
            ],
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('posts.index'),
            ],
        ];
    }
}
