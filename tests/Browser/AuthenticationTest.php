<?php

namespace Kontenta\AdminManagerImplementation\Tests\Browser;

use Kontenta\AdminManagerImplementation\Tests\DuskTest;
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
             * @var $routeManager \Kontenta\AdminManager\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\AdminManager\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->type('email', $this->user->email)
                ->type('password', 'secret')
                ->press('Login')
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
             * @var $routeManager \Kontenta\AdminManager\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\AdminManager\Contracts\AdminRouteManager::class);
            $browser->loginAs($this->user)->visit($routeManager->indexUrl())
                ->press('Logout')
                ->assertUrlIs($routeManager->loginUrl());
        });
    }
}
