<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $modelPolicy;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Authenticatable $auth, Guard $auth_guard)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Authenticatable $auth)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Authenticatable $auth)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Authenticatable $auth)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Guard $authGuard)
    {
        $user = $authGuard->user();

        $model = $this->modelPolicy->find(1);

        $check = $user->can('update', $model);

        if (! $check) {
            echo 'Not Authorized.';

            return false;
        }

        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authenticatable $auth)
    {

    }
}
