<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Services\PageService;
use App\Traits\HttpPageTrait;

class PageController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageService $pageService, Request $request)
    {
        $pages = $pageService->getPaginated(config('app.url_admin').'/pages');

        $this->isEmptyPaginated($pages, $request);

        return view(config('app.theme').'admin.pages.index', [
            'pages' => $pages,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, PageService $pageService, Authenticatable $auth)
	{
		$pageService->create($request->except(['seotitle','seodescription','seokeywords']),$auth);

		return redirect()->route(config('app.theme').'admin.pages.index');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PageService $pageService)
    {
        $page = $pageService->getByIdWithSeo($id);

        $this->isEmptyPage($page);

        return view(config('app.theme').'admin.pages.edit', [
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PageService $pageService, Authenticatable $auth)
	{
		$pageService->update($request->except(['seotitle','seodescription','seokeywords']),$id, $auth);

		return redirect()->route(config('app.theme').'admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PageService $pageService)
    {
        $pageService->destroy($id);

        return redirect()->route(config('app.theme').'admin.pages.index');
    }
}
