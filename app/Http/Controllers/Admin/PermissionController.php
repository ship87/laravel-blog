<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Services\PermissionService;
use App\Traits\Controllers\HttpPageTrait;
use App\Traits\Controllers\PolicyTrait;
use App\Models\Permission;

class PermissionController extends Controller
{
    use HttpPageTrait;

    use PolicyTrait;

    protected $modelPolicy = Permission::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionService $permissionService, Request $request, Authenticatable $auth)
    {
        $this->indexPolicy($auth);
        $canEdit = $auth->can('edit', $this->modelPolicy->first());
        $canDelete = $auth->can('destroy', $this->modelPolicy->first());

        $permissions = $permissionService->getPaginated(config('app.url_admin').'/permissions');

        $this->isEmptyPaginated($permissions, $request);

        return view(config('app.theme').'admin.permissions.index', [
            'permissions' => $permissions,
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

        return view(config('app.theme').'admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request, PermissionService $permissionService, Authenticatable $auth)
    {
		$this->storePolicy($auth);

        $permissionService->create($request->all());

        return redirect()->route(config('app.theme').'admin.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, PermissionService $permissionService, Authenticatable $auth)
    {
		$this->editPolicy($auth);

        $permission = $permissionService->getByIdOrFail($id);

		$this->checkSystemAttribute($permission);

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
    public function update(PermissionRequest $request, $id, PermissionService $permissionService, Authenticatable $auth)
    {
		$this->updatePolicy($auth);

        $permissionService->update($request->all(),$id);

        return redirect()->route(config('app.theme').'admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, PermissionService $permissionService, Authenticatable $auth)
    {
		$this->destroyPolicy($auth);

        $permissionService->destroy($id);

        return redirect()->route(config('app.theme').'admin.permissions.index');
    }
}
