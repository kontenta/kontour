<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManagerImplementation\Tests\UserlandAdminToolTest;
use Illuminate\Support\Facades\Route;

class UserlandServiceProviderTest extends UserlandAdminToolTest
{
    public function test_routes_are_registered()
    {
        $this->assertTrue(Route::has('userland.index'), 'Expected route does not exist');
    }

    public function test_routes_contain_userland_prefix()
    {
        $this->assertContains('/userland-tool', route('userland.index'));
    }

    public function test_routes_contain_admin_prefix()
    {
        $this->assertContains('/' . config('admin.url_prefix'), route('userland.index'));
    }
}
