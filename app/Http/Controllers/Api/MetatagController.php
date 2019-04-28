<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MetatagService;
use App\Http\Resources\Metatag\MetatagResource;
use App\Http\Resources\Metatag\MetatagsResource;
use App\Http\Requests\MetatagRequest;

class MetatagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MetatagService $metatagService)
    {
        $metatags = $metatagService->getPaginated('metatags');

        return new MetatagsResource($metatags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(MetatagRequest $request, MetatagService $metatagService)
    {
        return $metatagService->create($request->get('attributes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, MetatagService $metatagService)
    {
        $metatag = $metatagService->getByIdOrFail($id);

        MetatagResource::withoutWrapping();

        return new MetatagResource($metatag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(MetatagRequest $request, $id, MetatagService $metatagService)
    {
        $attributes = $request->get('attributes');

        return $metatagService->update($attributes, $id, $attributes['updated_user_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, MetatagService $metatagService)
    {
        return $metatagService->destroy($id);
    }
}
