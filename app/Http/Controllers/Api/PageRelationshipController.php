<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Http\Resources\PageComment\PageCommentsResource;
use App\Http\Resources\Metatag\MetatagsResource;

class PageRelationshipController extends Controller
{
    public function comments(Page $page)
    {
        return new PageCommentsResource($page->comments);
    }

    public function metatags(Page $page)
    {
        return new MetatagsResource($page->metatags);
    }
}