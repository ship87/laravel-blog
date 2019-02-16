<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

use App\Http\Resources\Metatag\MetatagResource;
use App\Http\Resources\PageComment\PageCommentResource;
use App\Models\PageComment;
use App\Models\Metatag;

class PagesResource extends ResourceCollection
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
            'data' => PageResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        $comments = $this->collection->flatMap(function ($page) {
            return $page->comments;
        });
        $metatags = $this->collection->flatMap(function ($page) {
            return $page->metatags;
        });
        $included = $metatags->merge($comments)->unique();

        return [
            'links' => [
                'self' => route('pages.index'),
            ],
            'included' => $this->withIncluded($included),
        ];
    }

    private function withIncluded(Collection $included)
    {
        return $included->map(function ($include) {
            if ($include instanceof Metatag) {
                return new MetatagResource($include);
            }
            if ($include instanceof PageComment) {
                return new PageCommentResource($include);
            }
        });
    }
}
