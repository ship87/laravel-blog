<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Services\RoleService;
use App\Traits\Controllers\HttpPageTrait;
use App\Traits\Controllers\PolicyTrait;
use App\Models\User;

class UserController extends Controller
{
    use HttpPageTrait;

    use PolicyTrait;

    protected $modelPolicy = User::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserService $userService, Request $request, Authenticatable $auth)
    {
        $this->indexPolicy($auth);
        $canEdit = $auth->can('edit', $this->modelPolicy->first());
        $canDelete = $auth->can('destroy', $this->modelPolicy->first());

        $users = $userService->getPaginated(config('app.url_admin').'/users');

        $this->isEmptyPaginated($users, $request);

        return view(config('app.theme').'admin.users.index', [
            'users' => $users,
            'canEdit' => $canEdit,
            'canDelete' => $canDelete,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RoleService $roleService, Authenticatable $auth)
    {
        $this->createPolicy($auth);

        return view(config('app.theme').'admin.users.create', [
            'roles' => $roleService->getAllTitleId(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $userService, Authenticatable $auth)
    {
        $this->storePolicy($auth);

        $userService->create($request->all());

        return redirect()->route(config('app.theme').'admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, UserService $userService, RoleService $roleService, Authenticatable $auth)
    {
        $this->editPolicy($auth);

        $user = $userService->getByIdOrFail($id);

        return view(config('app.theme').'admin.users.edit', [
            'user' => $user,
            'roles' => $roleService->getAllTitleId(),
            'selectedRoles' => $roleService->getId($user->role),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id, UserService $userService, Authenticatable $auth)
    {
        $this->updatePolicy($auth);

        $userService->update($request->all(), $id);

        return redirect()->route(config('app.theme').'admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, UserService $userService, Authenticatable $auth)
    {
        $this->destroyPolicy($auth);

        $userService->destroy($id);

        return redirect()->route(config('app.theme').'admin.users.index');
    }
}
