<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		return [
			'data' => CategoryResource::collection($this->collection),
		];
    }

	public function with($request)
	{
		return [
			'links'    => [
				'self' => route('categories.index'),
			],
		];
	}
}
