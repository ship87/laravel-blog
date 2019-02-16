<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\Resource;

class RoleIdentifierResource extends Resource
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
            'type' => 'roles',
            'id' => (string) $this->id,
        ];
    }
}
