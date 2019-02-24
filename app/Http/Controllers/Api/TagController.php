<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TagService;
use App\Http\Resources\Tag\TagResource;
use App\Http\Resources\Tag\TagsResource;
use App\Http\Requests\TagRequest;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagService $tagService)
    {
        $tags = $tagService->getPaginated('tags');

        return new TagsResource($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request, TagService $tagService)
	{
		return $tagService->create($request->get('attributes'));
	}

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, TagService $tagService)
    {
        $tag = $tagService->getByIdOrFail($id);
        TagResource::withoutWrapping();

        return new TagResource($tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagRequest $request, $id, TagService $tagService)
    {
        $attributes = $request->get('attributes');

        return $tagService->update($attributes, $id, $attributes['updated_user_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, TagService $tagService)
	{
		return $tagService->destroy($id);
	}
}
