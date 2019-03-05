<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActionsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => ActionResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('roles.index'),
            ],
        ];
    }
}
