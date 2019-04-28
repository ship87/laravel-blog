<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Services\PageService;
use App\Traits\Controllers\HttpPageTrait;
use App\Traits\Controllers\PolicyTrait;
use App\Models\Page;

class PageController extends Controller
{
    use HttpPageTrait;

    use PolicyTrait;

    protected $modelPolicy = Page::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageService $pageService, Request $request, Authenticatable $auth)
    {
		$this->indexPolicy($auth);
		$canEdit = $auth->can('edit', $this->modelPolicy->first());
		$canDelete = $auth->can('destroy', $this->modelPolicy->first());

        $pages = $pageService->getPaginated(config('app.url_admin').'/pages', ['createdUser','updatedUser']);

        $this->isEmptyPaginated($pages, $request);

        return view(config('app.theme').'admin.pages.index', [
            'pages' => $pages,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PageService $pageService, Authenticatable $auth)
    {
		$this->createPolicy($auth);

        return view(config('app.theme').'admin.pages.create', [
            'parentPages' => $pageService->getAllTitleId(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request, PageService $pageService, Authenticatable $auth)
    {
		$this->storePolicy($auth);

        $pageService->create($request->all(), $request->relationData, $auth->id);

        return redirect($request->previousUrl);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PageService $pageService, Authenticatable $auth)
    {
		$this->editPolicy($auth);

        $page = $pageService->getByIdWithSeo($id);

        return view(config('app.theme').'admin.pages.edit', [
            'page' => $page,
            'parentPages' => $pageService->getAllTitleId(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request                   $request
     * @param $id
     * @param \App\Services\PageService                  $pageService
     * @param \Illuminate\Contracts\Auth\Authenticatable $auth
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, $id, PageService $pageService, Authenticatable $auth)
    {
		$this->updatePolicy($auth);

        $pageService->update($request->all(), $request->relationData, $id, $auth->id);

        return redirect($request->previousUrl);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PageService $pageService, Authenticatable $auth)
    {
		$this->destroyPolicy($auth);

        $pageService->destroy($id);

        return redirect()->route(config('app.theme').'admin.pages.index');
    }
}
