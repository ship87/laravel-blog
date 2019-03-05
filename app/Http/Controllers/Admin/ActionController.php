<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActionRequest;
use App\Services\ActionService;
use App\Traits\Controllers\HttpPageTrait;

class ActionController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ActionService $actionService, Request $request)
    {
        $actions = $actionService->getPaginated(config('app.url_admin').'/actions');

        $this->isEmptyPaginated($actions, $request);

        return view(config('app.theme').'admin.actions.index', [
            'actions' => $actions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.actions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActionRequest $request, ActionService $actionService)
    {
        $actionService->create($request->all());

        return redirect()->route(config('app.theme').'admin.actions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ActionService $actionService)
    {
        $action = $actionService->getByIdOrFail($id);

        return view(config('app.theme').'admin.actions.edit', [
            'action' => $action,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActionRequest $request, $id, ActionService $actionService)
    {
        $actionService->update($request->all(),$id);

        return redirect()->route(config('app.theme').'admin.actions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, ActionService $actionService)
    {
        $actionService->destroy($id);

        return redirect()->route(config('app.theme').'admin.actions.index');
    }
}
