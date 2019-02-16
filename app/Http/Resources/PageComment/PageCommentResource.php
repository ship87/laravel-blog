<?php

namespace App\Http\Resources\PageComment;

use Illuminate\Http\Resources\Json\Resource;

class PageCommentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type'          => 'page-comments',
            'id'            => (string)$this->id,
            'attributes'    => [
                'content' => $this->content,
                'page_id' => $this->page_id,
                'parent_id' => $this->parent_id,
                'created_user_id' => $this->created_user_id,
                'updated_user_id' => $this->updated_user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'links'         => [
                'self' => route('page-comments.show', ['page_comment' => $this->id]),
            ],
        ];
    }
}
