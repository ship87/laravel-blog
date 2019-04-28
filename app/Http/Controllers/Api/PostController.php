<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\PostService;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\PostsResource;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostService $postService, Request $request)
    {
        $search = $request->input('search');

        if (! empty($search)) {
            $posts = $postService->search($search);
        } else {
            $posts = $postService->getPaginated('posts');
        }

        return new PostsResource($posts);
    }

    /**
     * Store a newly created resource in storost.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request, PostService $postService)
    {
        $attributes = $request->get('attributes');

        return $postService->create($attributes, $request->get('relationships'), $attributes['created_user_id'], true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PostService $postService, Request $request)
    {
        $id = (int) $id;
        if ($id == 0) {
            abort(400);
        }

        $include = $postService->includeRelatedResources($request->input('include'));

        $post = $postService->getByParam(['id' => $id], $include['with'] ?? []);

        if (empty($post)) {
            abort(404);
        }

        PostResource::withoutWrapping();

        return new PostResource($post, $include['relatedResources'] ?? []);
    }

    /**
     * Update the specified resource in storost.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id, PostService $postService)
    {
        $attributes = $request->get('attributes');

        return $postService->update($attributes, $request->get('relationships'), $id, $attributes['updated_user_id'], true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostService $postService)
    {
        return $postService->destroy($id);
    }
}