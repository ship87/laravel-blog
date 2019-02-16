<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;

use App\Http\Resources\PostComment\PostCommentIdentifierResource;

class PostPostCommentsRelationshipResource extends ResourceCollection
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
            'data' => PostCommentIdentifierResource::collection($this->collection),
            'links' => [
                'self' => route('posts.relationships.post-comments', ['post' => $post->id]),
                'related' => route('posts.post-comments', ['post' => $post->id]),
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
