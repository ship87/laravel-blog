<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageCommentRequest;
use App\Services\PageCommentService;
use App\Traits\Controllers\HttpPageTrait;
use App\Traits\Controllers\PolicyTrait;
use App\Models\PageComment;

class PageCommentController extends Controller
{
    use HttpPageTrait;

    use PolicyTrait;

    protected $modelPolicy = PageComment::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageCommentService $pageCommentService, Request $request, Authenticatable $auth)
    {
        $this->indexPolicy($auth);
        $canEdit = $auth->can('edit', $this->modelPolicy->first());
        $canDelete = $auth->can('destroy', $this->modelPolicy->first());

        $pageComments = $pageCommentService->getPaginated(config('app.url_admin').'/page-comments', [
            'createdUser',
            'updatedUser',
        ]);

        $this->isEmptyPaginated($pageComments, $request);

        return view(config('app.theme').'admin.page-comments.index', [
            'pageComments' => $pageComments,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.page-comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageCommentRequest $request, PageCommentService $pageCommentService, Authenticatable $auth)
    {
        $pageCommentService->create($request->all(), $auth->id);

        return redirect()->route(config('app.theme').'admin.page-comments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PageCommentService $pageCommentService, Authenticatable $auth)
    {
        $this->editPolicy($auth);

        $pageComment = $pageCommentService->getByIdOrFail($id);

        return view(config('app.theme').'admin.page-comments.edit', [
            'pageComment' => $pageComment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(
        PageCommentRequest $request,
        $id,
        PageCommentService $pageCommentService,
        Authenticatable $auth
    ) {
        $this->updatePolicy($auth);

        $pageCommentService->update($request->all(), $id, $auth->id);

        return redirect()->route(config('app.theme').'admin.page-comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PageCommentService $pageCommentService, Authenticatable $auth)
    {
        $this->destroyPolicy($auth);

        $pageCommentService->destroy($id);

        return redirect()->route(config('app.theme').'admin.page-comments.index');
    }
}
