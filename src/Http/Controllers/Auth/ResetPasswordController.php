<?php

namespace Kontenta\AdminManagerImplementation\Http\Controllers\Auth;

use Kontenta\AdminManager\Contracts\AdminGuestMiddleware;
use Kontenta\AdminManager\Contracts\AdminRouteManager;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

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
        return view('admin::auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
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
