<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Illuminate\Support\Facades\Route;
use Kontenta\KontourSupport\Tests\UserlandAdminToolTest;
use Kontenta\Kontour\Contracts\AdminViewManager;
use Kontenta\Kontour\Contracts\AdminWidgetManager;

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
        $this->assertContains('/' . config('kontour.url_prefix'), route('userland.index'));
    }

    public function test_widget_manager_contains_widget()
    {
        $this->assertInstanceOf(Fakes\UserlandAdminWidget::class, app(AdminWidgetManager::class)->getAllWidgets()->get(0));
        $this->assertInstanceOf(Fakes\UnauthorizedWidget::class, app(AdminWidgetManager::class)->getAllWidgets()->get(1));
        $this->assertInstanceOf(Fakes\UserlandAdminWidget::class, app(AdminWidgetManager::class)->getWidgetsForSection(app(AdminViewManager::class)->widgetSection())->get(0));
    }
}
