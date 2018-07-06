<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Kontenta\KontourSupport\Tests\IntegrationTest;
use Illuminate\Support\Facades\Route;

class KontourServiceProviderTest extends IntegrationTest
{
    public function test_routes_are_registered()
    {
        $this->assertTrue(Route::has('admin.index'), 'Expected index route does not exist');
    }

    public function test_admin_guard_can_be_resolved()
    {
        $guard = $this->app->make(\Kontenta\Kontour\Contracts\AdminGuard::class);

        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Guard::class, $guard);
    }
}
