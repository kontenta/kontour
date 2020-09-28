<?php

namespace Kontenta\Kontour\Tests\Browser;

use Kontenta\Kontour\Tests\DuskTest;
use Laravel\Dusk\Browser;

class AuthenticationTest extends DuskTest
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function test_login()
    {
        $this->browse(function (Browser $browser) {
            /**
             * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->type('email', $this->user->email)
                ->type('password', 'secret')
                ->resize(500, 500)
                ->screenshot('docs/login')
                ->press('Log in')
                ->assertUrlIs($routeManager->indexUrl());
        });
    }

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function test_logout()
    {
        $this->browse(function (Browser $browser) {
            /**
             * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->loginAs($this->user, 'admin')->visit($routeManager->indexUrl())
                ->press('Log out')
                ->assertUrlIs($routeManager->loginUrl());
        });
    }
}
