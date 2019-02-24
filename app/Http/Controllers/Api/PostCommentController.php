<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PostCommentService;
use App\Http\Resources\PostComment\PostCommentResource;
use App\Http\Resources\PostComment\PostCommentsResource;
use App\Http\Requests\PostCommentRequest;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostCommentService $postCommentService)
    {
        $postComments = $postCommentService->getPaginated('postComments');

        return new PostCommentsResource($postComments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCommentRequest $request, PostCommentService $postComment)
	{
		return $postComment->create($request->get('attributes'));
	}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PostCommentService $postCommentService)
    {
        $postComment = $postCommentService->getByIdOrFail($id);
        PostCommentResource::withoutWrapping();

        return new PostCommentResource($postComment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCommentRequest $request, $id, PostCommentService $postCommentService)
    {
        $attributes = $request->get('attributes');

        return $postCommentService->update($attributes, $id, $attributes['updated_user_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostCommentService $postCommentService)
	{
		return $postCommentService->destroy($id);
	}
}
