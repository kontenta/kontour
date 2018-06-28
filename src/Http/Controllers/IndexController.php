<?php

namespace Kontenta\AdminManagerImplementation\Http\Controllers;

use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    /**
     * Index page for admins
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('admin::index');
    }
}
