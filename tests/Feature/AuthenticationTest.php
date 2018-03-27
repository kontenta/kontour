<?php

namespace Erik\AdminManagerImplementation\Tests\Feature;

use Erik\AdminManagerImplementation\Tests\IntegrationTest;
use Erik\AdminManagerImplementation\Tests\Feature\Fakes\User;

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
         * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);
        $response = $this->get($routeManager->indexUrl());

        $response->assertRedirect($routeManager->loginUrl());
    }

    public function test_json_guest_is_not_redirected()
    {
        /**
         * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);
        $response = $this->json('GET', $routeManager->indexUrl());

        $this->assertFalse($response->isRedirection(), 'Json request should not be redirected');
        $this->assertTrue($response->isClientError(), 'Json guest response should be a client error');
    }

    public function test_login_url()
    {
        /**
         * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);
        $response = $this->get($routeManager->loginUrl());

        $response->assertSuccessful();
    }

    public function test_login()
    {
        /**
         * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);
        $response = $this->post($routeManager->loginUrl(), ['email' => $this->user->email, 'password' => 'secret']);

        $response->assertRedirect($routeManager->indexUrl());
    }

    public function test_logout()
    {
        /**
         * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);
        $response = $this->actingAs($this->user)->post($routeManager->logoutUrl());

        $response->assertRedirect($routeManager->loginUrl());
        $this->assertGuest();
    }
}
