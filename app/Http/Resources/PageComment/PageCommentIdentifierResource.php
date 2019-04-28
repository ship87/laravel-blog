<?php

namespace App\Http\Resources\PageComment;

use Illuminate\Http\Resources\Json\Resource;

class PageCommentIdentifierResource extends Resource
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
            'type' => 'page-comments',
            'id' => (string) $this->id,
        ];
    }
}
