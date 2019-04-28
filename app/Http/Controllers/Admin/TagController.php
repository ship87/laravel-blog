<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Services\TagService;
use App\Traits\Controllers\HttpPageTrait;
use App\Traits\Controllers\PolicyTrait;
use App\Models\Tag;

class TagController extends Controller
{
    use HttpPageTrait;

    use PolicyTrait;

    protected $modelPolicy = Tag::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagService $tagService, Request $request, Authenticatable $auth)
    {
        $this->indexPolicy($auth);
        $canEdit = $auth->can('edit', $this->modelPolicy->first());
        $canDelete = $auth->can('destroy', $this->modelPolicy->first());

        $tags = $tagService->getPaginated(config('app.url_admin').'/tags');

        $this->isEmptyPaginated($tags, $request);

        return view(config('app.theme').'admin.tags.index', [
            'tags' => $tags,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Authenticatable $auth)
    {
        $this->createPolicy($auth);

        return view(config('app.theme').'admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagRequest $request, TagService $tagService, Authenticatable $auth)
    {
        $this->storePolicy($auth);

        $tagService->create($request->all());

        return redirect()->route(config('app.theme').'admin.tags.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, TagService $tagService, Authenticatable $auth)
    {
        $this->editPolicy($auth);

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
    public function update(TagRequest $request, $id, TagService $tagService, Authenticatable $auth)
    {
        $this->updatePolicy($auth);

        $tagService->update($request->all(), $id);

        return redirect()->route(config('app.theme').'admin.tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, TagService $tagService, Authenticatable $auth)
    {
        $this->destroyPolicy($auth);

        $tagService->destroy($id);

        return redirect()->route(config('app.theme').'admin.tags.index');
    }
}
