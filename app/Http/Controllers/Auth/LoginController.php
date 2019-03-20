<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends CustomFolderController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

	protected $maxAttempts;

	protected $decayMinutes;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		parent::__construct();

        $this->middleware('guest')->except('logout');

		$this->maxAttempts = config('app.login_max_attempts');

		$this->decayMinutes = config('app.login_decay_minutes');
    }

	public function showLoginForm()
	{
		return view(config('app.theme').'auth.login');
	}
}
