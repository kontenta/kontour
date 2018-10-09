<?php

namespace Kontenta\KontourSupport\Http\Controllers\Auth;

use Kontenta\Kontour\Contracts\AdminGuestMiddleware;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    use ValidatesRequests;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(AdminGuestMiddleware::class);
    }

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return view('kontour::auth.passwords.email');
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


}
