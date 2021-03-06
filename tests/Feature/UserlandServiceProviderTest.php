<?php

namespace Kontenta\Kontour\Tests\Feature;

use Illuminate\Support\Facades\Route;
use Kontenta\Kontour\Contracts\AdminWidgetManager;
use Kontenta\Kontour\Tests\IntegrationTest;
use Kontenta\Kontour\Tests\UserlandTestSetupTrait;

class UserlandServiceProviderTest extends IntegrationTest
{
    use UserlandTestSetupTrait;

    public function test_routes_are_registered()
    {
        $this->assertTrue(Route::has('userland.index'), 'Expected route does not exist');
    }

    public function test_routes_contain_userland_prefix()
    {
        $this->assertStringContainsString('/userland-tool', route('userland.index'));
    }

    public function test_routes_contain_admin_prefix()
    {
        $this->assertStringContainsString('/' . config('kontour.url_prefix'), route('userland.index'));
    }

    public function test_widget_manager_contains_widget()
    {
        $this->assertCount(1, app(AdminWidgetManager::class)->getAllWidgets()->whereInstanceOf(Fakes\UserlandAdminWidget::class));
        $this->assertCount(1, app(AdminWidgetManager::class)->getAllWidgets()->whereInstanceOf(Fakes\UnauthorizedWidget::class));
        $this->assertCount(1, app(AdminWidgetManager::class)->getWidgetsForSection('kontourWidgets')->whereInstanceOf(Fakes\UserlandAdminWidget::class));
    }

    public function test_widget_manager_section_is_empty()
    {
        $this->assertTrue(app(AdminWidgetManager::class)->getWidgetsForSection('hoppaulleulleulle')->isEmpty());
    }
}
