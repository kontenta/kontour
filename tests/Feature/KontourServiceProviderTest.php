<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Illuminate\Support\Facades\Route;
use Kontenta\KontourSupport\Tests\IntegrationTest;
use Kontenta\Kontour\Contracts\MenuWidget;

class KontourServiceProviderTest extends IntegrationTest
{
    public function test_routes_are_registered()
    {
        $this->assertTrue(Route::has('kontour.index'), 'Expected index route does not exist');
    }

    public function test_admin_guard_can_be_resolved()
    {
        $guard = $this->app->make('kontour.guard');

        $this->assertInstanceOf(\Illuminate\Contracts\Auth\Guard::class, $guard);
    }

    public function test_menu_widget_can_resolved()
    {
        $this->assertInstanceOf(MenuWidget::class, app(MenuWidget::class));
    }
}
