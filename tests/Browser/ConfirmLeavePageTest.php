<?php

namespace Kontenta\Kontour\Tests\Browser;

use Kontenta\Kontour\Tests\DuskTest;
use Laravel\Dusk\Browser;

class ConfirmLeavePageTest extends DuskTest
{
    public function test_no_confirm_leave()
    {
        $this->browse(function (Browser $browser) {
            /**
             * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->visit('/')
                ->assertPathIs('/');
        });
    }

    public function test_confirm_leave_after_changes()
    {
        $this->browse(function (Browser $browser) {
            /**
             * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->type('email', $this->user->email)
                ->waitFor('[data-kontour-dirty="true"]')
                ->visit('/')
                ->waitForDialog()
                ->dismissDialog()
                ->assertUrlIs($routeManager->loginUrl());
        });
    }
}
