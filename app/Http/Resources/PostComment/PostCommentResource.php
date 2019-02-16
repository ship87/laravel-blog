<?php

namespace App\Http\Resources\PostComment;

use Illuminate\Http\Resources\Json\Resource;

class PostCommentResource extends Resource
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
            'type' => 'post-comments',
            'id' => (string) $this->id,
            'attributes' => [
                'content' => $this->content,
                'post_id' => $this->post_id,
                'parent_id' => $this->parent_id,
                'created_user_id' => $this->created_user_id,
                'updated_user_id' => $this->updated_user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'links' => [
                'self' => route('post-comments.show', ['post_comment' => $this->id]),
            ],
        ];
    }
}
