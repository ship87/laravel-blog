<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Services\PageCommentService;
use App\Traits\HttpPageTrait;

class PageCommentController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageCommentService $pageCommentService, Request $request)
    {
        $pageComments = $pageCommentService->getPaginated(config('app.url_admin').'/page-comments');

        $this->isEmptyPaginated($pageComments, $request);

        return view(config('app.theme').'admin.page-comments.index', [
            'pageComments' => $pageComments,
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
    public function store(Request $request, PageCommentService $pageCommentService, Authenticatable $auth)
	{
		$pageCommentService->create($request->all(),$auth);

		return redirect()->route(config('app.theme').'admin.page-comments.index');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PageCommentService $pageCommentService)
    {
        $pageComment = $pageCommentService->getById($id);

        $this->isEmptyPage($pageComment);

        return view(config('app.theme').'admin.page-comments.edit', [
            'pageComment' => $pageComment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, PageCommentService $pageCommentService, Authenticatable $auth)
	{
		$pageCommentService->update($request->all(),$id,$auth);

		return redirect()->route(config('app.theme').'admin.page-comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PageCommentService $pageCommentService)
    {
        $pageCommentService->destroy($id);

        return redirect()->route(config('app.theme').'admin.page-comments.index');
    }
}
