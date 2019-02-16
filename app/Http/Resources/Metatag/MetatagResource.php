<?php

namespace App\Http\Resources\Metatag;

use Illuminate\Http\Resources\Json\Resource;

class MetatagResource extends Resource
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
            'type' => 'metatags',
            'id' => (string) $this->id,
            'attributes' => [
                'type' => $this->type,
                'page_id' => $this->page_id,
                'post_id' => $this->post_id,
                'name' => $this->name,
                'content' => $this->content,
            ],
            'links' => [
                'self' => route('metatags.show', ['metatag' => $this->id]),
            ],
        ];
    }
}
