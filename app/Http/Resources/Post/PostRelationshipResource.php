<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\Resource;

class PostRelationshipResource extends Resource
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
            'comments' => (new PostPostCommentsRelationshipResource($this->comments))->additional(['post' => $this]),
            'metatags' => (new PostMetatagsRelationshipResource($this->metatags))->additional(['post' => $this]),
            'categories' => (new PostCategoriesRelationshipResource($this->categories))->additional(['post' => $this]),
            'tags' => (new PostTagsRelationshipResource($this->tags))->additional(['post' => $this]),
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
