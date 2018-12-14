<?php

namespace Kontenta\Kontour\Tests\Browser;

use Kontenta\Kontour\Tests\DuskTest;
use Laravel\Dusk\Browser;

class SkipToContentTest extends DuskTest
{
    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function test_skip_to_content()
    {
        $this->browse(function (Browser $browser) {
            /**
             * @var $routeManager \Kontenta\Kontour\Contracts\AdminRouteManager
             */
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                //->assertDontSeeLink('Skip to content')
                ->keys('', '{tab}')
                ->assertFocused('#skip-to-content')
                ->assertSeeLink('Skip to content')
                ->keys('#skip-to-content', '{enter}')
                ->assertNotFocused('#skip-to-content')
                ->assertFragmentIs('kontourMain');
        });
    }
}
