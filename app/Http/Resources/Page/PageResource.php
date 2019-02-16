<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\Resource;

class PageResource extends Resource
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
            'type' => 'pages',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'content' => $this->content,
                'parent_id' => $this->parent_id,
                'no_comments' => $this->no_comments,
                'created_user_id' => $this->created_user_id,
                'updated_user_id' => $this->updated_user_id,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'relationships' => new PageRelationshipResource($this),
            'links' => [
                'self' => route('pages.show', ['page' => $this->id]),
            ],
        ];
    }
}
