<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\Resource;

use App\Traits\RelateResourceTrait;

class PostResource extends Resource
{
    use RelateResourceTrait;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $post = [
            'type' => 'posts',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'no_comments' => $this->no_comments,
                'created_user_id' => $this->created_user_id,
                'updated_user_id' => $this->updated_user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'relationships' => new PostRelationshipResource($this),
            'links' => [
                'self' => route('posts.show', ['post' => $this->id]),
            ],
        ];

        if (! empty($this->include) && is_array($this->include)) {
            return $this->includedResource($this->include, $post);
        }

        return $post;
    }
}
