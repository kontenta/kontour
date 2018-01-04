<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManagerImplementation\Tests\IntegrationTest;

class AdminManagerServiceProviderTest extends IntegrationTest
{
    public function test_admin_guard_can_be_resolved()
    {
        $guard = $this->app->make(\Erik\AdminManager\Contracts\Guard::class);

        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Guard::class, $guard);
    }
}
