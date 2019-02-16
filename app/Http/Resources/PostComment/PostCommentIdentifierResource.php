<?php

namespace App\Http\Resources\PostComment;

use Illuminate\Http\Resources\Json\Resource;

class PostCommentIdentifierResource extends Resource
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
        ];
    }
}
