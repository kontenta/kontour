<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManager\Contracts\AdminRouteManager;
use Erik\AdminManagerImplementation\Tests\IntegrationTest;
use Illuminate\Foundation\Auth\User;

class AuthenticationTest extends IntegrationTest
{
    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();
    }

    public function test_guest_is_redirected_to_login()
    {
        /**
         * @var $routeManager AdminRouteManager
         */
        $routeManager = $this->app->make(AdminRouteManager::class);
        $response = $this->get($routeManager->indexUrl());

        $response->assertRedirect($routeManager->loginUrl());
    }

    // TODO: test_ajax_guest_is_not_redirected

    // TODO: test login procedure - with Dusk? https://laravel.com/docs/5.5/dusk
}
