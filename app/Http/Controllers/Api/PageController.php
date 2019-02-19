<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\PageService;
use App\Http\Resources\Page\PageResource;
use App\Http\Resources\Page\PagesResource;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageService $pageService)
    {
        $pages = $pageService->getPaginated('pages');

        return new PagesResource($pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PageService $pageService, Request $request)
    {
        $include = $pageService->includeData($request->input('include'));

        $page = $pageService->getByParam(['id' => $id], $include['with'] ?? []);

        PageResource::withoutWrapping();

        return new PageResource($page, $include['relatedResources'] ?? []);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
