<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostComment\PostCommentsResource;
use App\Http\Resources\Metatag\MetatagsResource;
use App\Http\Resources\Category\CategoriesResource;
use App\Http\Resources\Tag\TagsResource;
use App\Models\Post;

class PostRelationshipController extends Controller
{
    public function comments(Post $post)
    {
        return new PostCommentsResource($post->comments);
    }

    public function metatags(Post $post)
    {
        return new MetatagsResource($post->metatags);
    }

    public function categories(Post $post)
    {
        return new CategoriesResource($post->categories);
    }

    public function tags(Post $post)
    {
        return new TagsResource($post->tags);
    }
}