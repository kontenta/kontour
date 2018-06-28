<?php

namespace Kontenta\KontourImplementation\Tests\Feature;

use Kontenta\KontourImplementation\Tests\IntegrationTest;
use Kontenta\KontourImplementation\Tests\Feature\Fakes\User;

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
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->get($routeManager->indexUrl());

        $response->assertRedirect($routeManager->loginUrl());
    }

    public function test_json_guest_is_not_redirected()
    {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->json('GET', $routeManager->indexUrl());

        $this->assertFalse($response->isRedirection(), 'Json request should not be redirected');
        $this->assertTrue($response->isClientError(), 'Json guest response should be a client error');
    }

    public function test_login_url()
    {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->get($routeManager->loginUrl());

        $response->assertSuccessful();
    }

    public function test_login()
    {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->post($routeManager->loginUrl(), ['email' => $this->user->email, 'password' => 'secret']);

        $response->assertRedirect($routeManager->indexUrl());
    }

    public function test_index_route() {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->actingAs($this->user)->get($routeManager->indexUrl());

        $response->assertSuccessful();
    }

    public function test_logout()
    {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->actingAs($this->user)->post($routeManager->logoutUrl());

        $response->assertRedirect($routeManager->loginUrl());
        $this->assertGuest();
    }

    public function test_already_logged_in_user_is_redirected_from_login_url() {
        /**
         * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
         */
        $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
        $response = $this->actingAs($this->user)->get($routeManager->loginUrl());

        $response->assertRedirect($routeManager->indexUrl());

        $response->assertSessionMissing('url.intended');
    }
}
