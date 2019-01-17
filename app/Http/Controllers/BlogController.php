<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\BlogService;

class BlogController extends Controller
{
    public function index(BlogService $blogService, Request $request)
    {
        $posts = $blogService->getPostsPaginated();

        if (empty($posts)) {
            abort(404);
        }

        $currentPage = $request->input('page');

        if (! empty($currentPage)) {
            $currentPage = (int) $currentPage;
            if ($currentPage == 0 || $currentPage > $posts->lastPage()) {
                abort(404);
            }
        }

        return view('client/blog/index', ['posts' => $posts]);
    }

    public function page(BlogService $blogService, $id, $slug)
    {
        $postData = $blogService->getPost($id, $slug);


        if (! $postData) {
            abort(404);
        }

        return view('client/blog/post', [
            'postData' => $postData
        ]);
    }
}