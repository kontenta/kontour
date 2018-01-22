<?php

namespace Erik\AdminManagerImplementation\Tests\Browser;

use Erik\AdminManagerImplementation\Tests\DuskTest;
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
             * @var $routeManager \Erik\AdminManager\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Erik\AdminManager\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->assertSee('E-Mail Address');
            //TODO: test full login experience
        });
    }
}
