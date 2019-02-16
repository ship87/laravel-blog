<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

use App\Http\Resources\Metatag\MetatagResource;
use App\Http\Resources\PostComment\PostCommentResource;
use App\Models\PostComment;
use App\Models\Metatag;

class PostsResource extends ResourceCollection
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
            'data' => PostResource::collection($this->collection),
        ];
    }

    public function with($request)
    {
        $comments = $this->collection->flatMap(function ($post) {
            return $post->comments;
        });
        $metatags = $this->collection->flatMap(function ($post) {
            return $post->metatags;
        });
        $included = $metatags->merge($comments)->unique();

        return [
            'links' => [
                'self' => route('posts.index'),
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
            if ($include instanceof PostComment) {
                return new PostCommentResource($include);
            }
        });
    }
}
