<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class CustomFolderController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->setRedirectTo(config('app.url_admin'));
    }

    /**
     * @param string $redirectTo
     */
    public function setRedirectTo(string $redirectTo)
    {

        $this->redirectTo = $redirectTo;
    }
}