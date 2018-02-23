<?php

namespace Erik\AdminManagerImplementation\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

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
        //TODO: replace the standard guest middleware with a specific admin one
        $this->middleware('guest', [config('admin.guard')]);
    }

    public function showLinkRequestForm()
    {
        return view('admin::auth.passwords.email');
    }


}
