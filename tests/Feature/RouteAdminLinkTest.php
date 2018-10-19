<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\RouteAdminLink;
use Kontenta\Kontour\Tests\IntegrationTest;

class RouteAdminLinkTest extends IntegrationTest
{
    /**
     * Configure the environment.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Test with Laravel's default password reset config
        // This is to have the route kontour.password.reset requiring parameter token available
        $app['config']->set('kontour.passwords', 'users');
        parent::getEnvironmentSetUp($app);
    }

    public function test_url_is_null_when_route_does_not_exist()
    {
        $link = new RouteAdminLink('Gone', 'not.existing');

        $this->assertNull($link->getUrl());
        $this->assertEquals('<a >Gone</a>', $link->toHtml());
    }

    public function test_url_is_null_when_parameters_missing()
    {
        $link = new RouteAdminLink('Reset password', 'kontour.password.reset');

        $this->assertNull($link->getUrl());
    }

    public function test_route_parameters_can_be_added_in_constructor()
    {
        $link = new RouteAdminLink('Reset password', 'kontour.password.reset', ["token" => 'abc']);

        $this->assertEquals(route('kontour.password.reset', ["token" => 'abc']), $link->getUrl());
    }

    public function test_route_parameters_can_be_added_fluently()
    {
        $link = new RouteAdminLink('Reset password', 'kontour.password.reset');
        $link = $link->withRouteParameters(["token" => 'abc']);

        $this->assertEquals(route('kontour.password.reset', ["token" => 'abc']), $link->getUrl());
    }

    public function test_can_be_created_statically()
    {
        $link = RouteAdminLink::create('Reset password', 'kontour.password.reset', ["token" => 'abc']);

        $this->assertTrue($link instanceof RouteAdminLink);
        $this->assertEquals(route('kontour.password.reset', ["token" => 'abc']), $link->getUrl());
    }
}
