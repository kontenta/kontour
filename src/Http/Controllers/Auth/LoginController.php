<?php

namespace Kontenta\Kontour\Http\Controllers\Auth;

use Kontenta\Kontour\Contracts\AdminGuestMiddleware;
use Kontenta\Kontour\Contracts\AdminRouteManager;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    use ValidatesRequests;

    /**
     * @var AdminRouteManager
     */
    protected $routeManager;

    /**
     * Create a new controller instance.
     *
     * @param AdminRouteManager $routeManager
     */
    public function __construct(AdminRouteManager $routeManager)
    {
        $this->middleware(AdminGuestMiddleware::class)->except('logout');

        $this->routeManager = $routeManager;
    }

    /**
     * Show the application's login form.
     * @see \Illuminate\Foundation\Auth\AuthenticatesUsers::showLoginForm()
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('kontour::auth.login');
    }

    /**
     * Log the user out of the application.
     * @see \Illuminate\Foundation\Auth\AuthenticatesUsers::logout()
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        /**
         * Logout does *not* destroy the session (like the AuthenticatesUsers trait does).
         * @see \Illuminate\Foundation\Auth\AuthenticatesUsers::logout()
         */

        return redirect($this->routeManager->loginUrl());
    }

    /**
     * Get the guard to be used during authentication.
     * @see \Illuminate\Foundation\Auth\AuthenticatesUsers::guard()
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(config('kontour.guard'));
    }

    /**
     * Get the post login redirect path.
     * @see \Illuminate\Foundation\Auth\RedirectsUsers::redirectPath()
     *
     * @return string
     */
    protected function redirectTo()
    {
        return $this->routeManager->indexUrl();
    }
}
