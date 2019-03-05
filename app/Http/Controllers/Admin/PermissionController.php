<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;
use App\Traits\Controllers\HttpPageTrait;

class PermissionController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionService $permissionService, Request $request)
    {
        $permissions = $permissionService->getPaginated(config('app.url_admin').'/permissions');

        $this->isEmptyPaginated($permissions, $request);

        return view(config('app.theme').'admin.permissions.index', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request, PermissionService $permissionService)
    {
        $permissionService->create($request->all());

        return redirect()->route(config('app.theme').'admin.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PermissionService $permissionService)
    {
        $permission = $permissionService->getByIdOrFail($id);

        return view(config('app.theme').'admin.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id, PermissionService $permissionService)
    {
        $permissionService->update($request->all(),$id);

        return redirect()->route(config('app.theme').'admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PermissionService $permissionService)
    {
        $permissionService->destroy($id);

        return redirect()->route(config('app.theme').'admin.permissions.index');
    }
}
