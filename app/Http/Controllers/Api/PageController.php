<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\PageService;
use App\Http\Resources\Page\PageResource;
use App\Http\Resources\Page\PagesResource;
use App\Http\Requests\PageRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageService $pageService, Request $request)
    {
        $orderBy = $pageService->sortData($request->input('sort'));
        $where = $pageService->filterData($request->all());
        $pages = $pageService->getPaginated('pages', false, $where, $orderBy);

        return new PagesResource($pages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request, PageService $pageService)
    {
        $attributes = $request->get('attributes');

        return $pageService->create($attributes, $request->get('relationships'), $attributes['created_user_id'], true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, PageService $pageService, Request $request)
    {
        $id = (int) $id;
        if ($id === 0) {
            abort(400);
        }

        $include = $pageService->includeRelatedResources($request->input('include'));

        $page = $pageService->getByParam(['id' => $id], ($include['with'] ?? []));

        if (empty($page)) {
            abort(404);
        }

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
    public function update(PageRequest $request, $id, PageService $pageService)
    {
        $attributes = $request->get('attributes');

        return $pageService->update($attributes, $request->get('relationships'), $id, $attributes['updated_user_id'], true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PageService $pageService)
    {
        return $pageService->destroy($id);
    }
}
