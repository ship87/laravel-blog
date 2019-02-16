<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Services\UserService;
use App\Traits\HttpPageTrait;

class UserController extends Controller
{
    use HttpPageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserService $userService, Request $request)
    {
        $users = $userService->getPaginated(config('app.url_admin').'/users');

        $this->isEmptyPaginated($users, $request);

        return view(config('app.theme').'admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(config('app.theme').'admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $userService)
	{
		$userService->create($request->all());

		return redirect()->route(config('app.theme').'admin.users.index');
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, UserService $userService)
    {
        $user = $userService->getByIdOrFail($id);

        return view(config('app.theme').'admin.users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id, UserService $userService)
	{
		$userService->update($request->all(),$id);

		return redirect()->route(config('app.theme').'admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, UserService $userService)
    {
        $userService->destroy($id);

        return redirect()->route(config('app.theme').'admin.users.index');
    }
}
