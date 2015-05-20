<?php

namespace Jai\Backend\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

/**
 * 
 * @author kora jai <kora.jayaram@gmail>
 * TODO: Password Recovery
 */
class BackendAuthController extends Controller
{
	use AuthenticatesAndRegistersUsers;

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth                = $auth;
		$this->registrar           = $registrar;
		$this->redirectTo          = '/backend/Link/all';
		$this->redirectAfterLogout = '/backend/Link/all';
		$this->loginPath           = '/backendAuth/login';

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	/**
	 * Show the application login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getLogin()
	{
		return view('BackendViews::backendlogin');
	}

	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getRegister()
	{
		// Do not show this  when use is logged in
		return view('BackendViews::backendregister');
	}



}