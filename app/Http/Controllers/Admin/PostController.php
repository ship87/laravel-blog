<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Services\TagService;
use App\Traits\HttpPageTrait;

class PostController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostService $postService, Request $request)
    {
        $posts = $postService->getPaginated(config('app.url_admin').'/posts');

        $this->isEmptyPaginated($posts, $request);

        return view(config('app.theme').'admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CategoryService $categoryService, TagService $tagService)
    {
        return view(config('app.theme').'admin.posts.create', [
            'tags' => $tagService->getAllNameId(),
            'categories' => $categoryService->getAllTitleId(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostService $postService, Authenticatable $auth)
    {
        $postService->create($request->all(), $request->relationData, $auth);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostService $postService, CategoryService $categoryService, TagService $tagService)
    {
        $post = $postService->getByIdWithSeo($id);

        return view(config('app.theme').'admin.posts.edit', [
            'post' => $post,
            'tags' => $tagService->getAllNameId(),
            'selectedTags' => $tagService->getId($post->tags),
            'categories' => $categoryService->getAllTitleId(),
            'selectedCategories' => $categoryService->getId($post->categories),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id, PostService $postService, Authenticatable $auth)
    {
        $postService->update($request->all(), $request->relationData, $id, $auth);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostService $postService)
    {
        $postService->destroy($id);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }
}
