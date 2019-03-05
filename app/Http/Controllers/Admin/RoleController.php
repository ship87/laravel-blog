<?php

namespace App\Http\Controllers\Admin;

use App\Services\PermissionService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use App\Traits\Controllers\HttpPageTrait;

class RoleController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RoleService $roleService, Request $request)
    {
        $roles = $roleService->getPaginated(config('app.url_admin').'/roles');

        $this->isEmptyPaginated($roles, $request);

        return view(config('app.theme').'admin.roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(PermissionService $permissionService)
    {
        return view(config('app.theme').'admin.roles.create',[
			'permissions' => $permissionService->getAllTitleId(),
		]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request, RoleService $roleService)
    {
        $roleService->create($request->all(), $request->relationData);

        return redirect()->route(config('app.theme').'admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, RoleService $roleService,PermissionService $permissionService)
    {
        $role = $roleService->getByIdOrFail($id);

        return view(config('app.theme').'admin.roles.edit', [
            'role' => $role,
			'permissions' => $permissionService->getAllTitleId(),
			'selectedPermissions' => $permissionService->getId($role->permissions),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id, RoleService $roleService)
    {
        $roleService->update($request->all(), $request->relationData, $id);

        return redirect()->route(config('app.theme').'admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, RoleService $roleService)
    {
        $roleService->destroy($id);

        return redirect()->route(config('app.theme').'admin.roles.index');
    }
}
