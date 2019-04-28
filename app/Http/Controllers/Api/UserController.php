<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserService $userService)
    {
        $users = $userService->getPaginated('users');

        return new UsersResource($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $userService)
    {
        return $userService->create($request->get('attributes'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, UserService $userService)
    {
        $user = $userService->getByIdOrFail($id);
        UserResource::withoutWrapping();

        return new UserResource($user);
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
        $attributes = $request->get('attributes');

        return $userService->update($attributes, $id, $attributes['updated_user_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, UserService $userService)
    {
        return $userService->destroy($id);
    }
}
