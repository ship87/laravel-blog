<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Services\PostService;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostService $postService)
    {
        $posts = $postService->getPaginated(config('app.url_admin').'/posts');

        return view(config('app.theme').'admin.posts.index', [
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PostService $postService, Authenticatable $auth)
    {
        $postService->create($request->all(), $auth);

        return redirect()->route(config('app.theme').'admin.posts.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostService $postService, Authenticatable $auth)
    {
        $post = $postService->getPost($id, $auth);

        return view(config('app.theme').'admin.posts.edit', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PostService $postService, Authenticatable $auth)
	{
		$postService->update($request->all(),$id,$auth);

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
