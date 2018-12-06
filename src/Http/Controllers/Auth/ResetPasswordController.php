<?php

namespace Kontenta\Kontour\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Kontenta\Kontour\Contracts\AdminGuestMiddleware;
use Kontenta\Kontour\Contracts\AdminRouteManager;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;
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
        $this->middleware(AdminGuestMiddleware::class);

        $this->routeManager = $routeManager;
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  string|null $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('kontour::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Auth\Passwords\PasswordBroker
     */
    public function broker()
    {
        return Password::broker(config('kontour.passwords', null));
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard(config('kontour.guard'));
    }

    /**
     * Get the post password reset redirect path.
     * @see \Illuminate\Foundation\Auth\RedirectsUsers::redirectPath()
     *
     * @return string
     */
    protected function redirectTo()
    {
        return $this->routeManager->indexUrl();
    }
}
