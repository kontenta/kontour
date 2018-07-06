<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;

class UserlandController extends BaseController
{
    public function index()
    {
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
