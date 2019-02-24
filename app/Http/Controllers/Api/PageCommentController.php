<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PageCommentService;
use App\Http\Resources\PageComment\PageCommentResource;
use App\Http\Resources\PageComment\PageCommentsResource;
use App\Http\Requests\PageCommentRequest;

class PageCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageCommentService $metatagService)
    {
        $metatags = $metatagService->getPaginated('metatags');

        return new PageCommentsResource($metatags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCommentRequest $request, PageCommentService $pageCommentService)
    {
        return $pageCommentService->create($request->get('attributes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PageCommentService $pageCommentService)
    {
        $pageComment = $pageCommentService->getByIdOrFail($id);
        PageCommentResource::withoutWrapping();

        return new PageCommentResource($pageComment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageCommentRequest $request, $id, PageCommentService $pageCommentService)
    {
        $attributes = $request->get('attributes');

        return $pageCommentService->update($attributes, $id, $attributes['updated_user_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PageCommentService $pageCommentService)
    {
        return $pageCommentService->destroy($id);
    }
}
