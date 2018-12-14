<?php

namespace Kontenta\Kontour\Tests\Feature;

use Illuminate\Support\Facades\Route;
use Kontenta\Kontour\Tests\UserlandAdminToolTest;
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
        $this->assertInstanceOf(Fakes\UserlandAdminWidget::class, app(AdminWidgetManager::class)->getAllWidgets()->get(2));
        $this->assertInstanceOf(Fakes\UnauthorizedWidget::class, app(AdminWidgetManager::class)->getAllWidgets()->get(3));
        $this->assertInstanceOf(Fakes\UserlandAdminWidget::class, app(AdminWidgetManager::class)->getWidgetsForSection('kontourWidgets')->get(2));
    }

    public function test_widget_manager_section_is_empty()
    {
        $this->assertTrue(app(AdminWidgetManager::class)->getWidgetsForSection('hoppaulleulleulle')->isEmpty());
    }
}
