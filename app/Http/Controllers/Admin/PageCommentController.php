<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\PageCommentService;


class PageCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PageCommentService $pageCommentService)
    {
        $pageComments = $pageCommentService->getPaginated(config('app.url_admin').'/page-comments');

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PageCommentService $pageCommentService)
    {

        $pageComment = $pageCommentService->show($id);

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
    public function update(Request $request, $id, PageCommentService $pageCommentService)
	{
		$pageCommentService->update($request->all(),$id);

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
