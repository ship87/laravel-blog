<?php

namespace App\Http\Resources\Metatag;

use Illuminate\Http\Resources\Json\Resource;

class MetatagIdentifierResource extends Resource
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
			'type'          => 'metatags',
			'id'            => (string)$this->id,
		];
	}
}
