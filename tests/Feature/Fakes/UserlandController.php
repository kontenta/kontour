<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\KontourSupport\AdminLink;
use Kontenta\Kontour\ShowAdminVisit;

class UserlandController extends BaseController
{
    public function index()
    {
        $link = new AdminLink(url()->full(), 'Recent Userland Tool');
        $user = Auth::guard(config('kontour.guard'))->user();
        $visit = new ShowAdminVisit($link, $user);
        event(new AdminToolVisited($visit));
        return view('userland::index');
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
