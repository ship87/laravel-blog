<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Services\TagService;
use App\Traits\Controllers\HttpPageTrait;

class TagController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagService $tagService, Request $request)
    {
        $tags = $tagService->getPaginated(config('app.url_admin').'/tags');

        $this->isEmptyPaginated($tags, $request);

        return view(config('app.theme').'admin.tags.index', [
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request, TagService $tagService)
	{
		$tagService->create($request->all());

		return redirect()->route(config('app.theme').'admin.tags.index');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TagService $tagService)
    {
        $tag = $tagService->getByIdOrFail($id);

        return view(config('app.theme').'admin.tags.edit', [
            'tag' => $tag,
        ]);
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
		$tagService->update($request->all(),$id);

		return redirect()->route(config('app.theme').'admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, TagService $tagService)
    {
        $tagService->destroy($id);

        return redirect()->route(config('app.theme').'admin.tags.index');
    }
}
