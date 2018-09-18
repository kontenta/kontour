<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Events\AdminToolShowVisited;
use Kontenta\KontourSupport\AdminLink;
use Kontenta\KontourSupport\UrlVisit;

class UserlandController extends BaseController
{
    public function index()
    {
        $link = new AdminLink(url()->full(), 'Recent Userland Tool');
        $user = Auth::guard(config('kontour.guard'))->user();
        $visit = new UrlVisit($link, $user);
        event(new AdminToolShowVisited($visit));
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
