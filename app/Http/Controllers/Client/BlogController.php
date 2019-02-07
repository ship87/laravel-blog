<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\BlogService;
use App\Traits\HttpPageTrait;

class BlogController extends Controller
{
    use HttpPageTrait;

    public function index(BlogService $blogService, Request $request)
    {
        $posts = $blogService->getPaginated();

        $this->isEmptyPaginated($posts, $request);

        return view(config('app.theme').'client/blog/index', [
            'posts' => $posts,
        ]);
    }

    public function indexArchive(BlogService $blogService, Request $request, $year, $month = false, $day = false)
    {
        $posts = $blogService->getArchivePostsPaginated($year, $month, $day);

        $this->isEmptyPaginated($posts, $request);

        return view(config('app.theme').'client/blog/index', [
            'posts' => $posts,
        ]);
    }

    public function indexCategory(BlogService $blogService, Request $request, $category)
    {
        $posts = $blogService->getCategoryPostsPaginated($category);

        $this->isEmptyPaginated($posts, $request);

        return view(config('app.theme').'client/blog/index', [
            'posts' => $posts,
        ]);
    }

    public function page(BlogService $blogService, $id, $slug)
    {
        $pageData = $blogService->getByIdSlug($id, $slug);

        $this->isEmptyPage($pageData);

        return view(config('app.theme').'client/blog/post', [
            'pageData' => $pageData,
        ]);
    }
}