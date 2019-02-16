<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostCommentRequest;
use App\Services\PostCommentService;
use App\Traits\HttpPageTrait;

class PostCommentController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostCommentService $postCommentService, Request $request)
    {
        $postComments = $postCommentService->getPaginated(config('app.url_admin').'/post-comments');

        $this->isEmptyPaginated($postComments, $request);

        return view(config('app.theme').'admin.post-comments.index', [
            'postComments' => $postComments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.post-comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCommentRequest $request, PostCommentService $postCommentService, Authenticatable $auth)
	{
		$postCommentService->create($request->all(),$auth);

		return redirect()->route(config('app.theme').'admin.post-comments.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PostCommentService $postCommentService)
    {
        $postComment = $postCommentService->getByIdOrFail($id);

        return view(config('app.theme').'admin.post-comments.edit', [
            'postComment' => $postComment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCommentRequest $request, $id, PostCommentService $postCommentService, Authenticatable $auth)
	{
		$postCommentService->update($request->all(),$id,$auth);

		return redirect()->route(config('app.theme').'admin.post-comments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PostCommentService $postCommentService)
    {
        $postCommentService->destroy($id);

        return redirect()->route(config('app.theme').'admin.post-comments.index');
    }
}
