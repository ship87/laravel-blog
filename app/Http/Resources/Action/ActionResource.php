<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\Resource;

class ActionResource extends Resource
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
            'type' => 'actions',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'slug' => $this->slug,
                'system' => $this->slug,
            ],
            'links' => [
                'self' => route('actions.show', ['action' => $this->id]),
            ],
        ];
    }
}
