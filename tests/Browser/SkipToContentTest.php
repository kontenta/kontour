<?php

namespace Kontenta\Kontour\Tests\Browser;

use Kontenta\Kontour\Tests\DuskTest;
use Laravel\Dusk\Browser;

class SkipToContentTest extends DuskTest
{
    protected $element = '#skip-to-content';

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
            $browser->loginAs($this->user, 'admin')->visit($routeManager->indexUrl());

            $this->assertEquals('inset(50%)', $browser->element($this->element)->getCSSValue('clip-path'));

            $browser->keys('', '{tab}')
                ->assertFocused($this->element);

            $this->assertEquals('none', $browser->element($this->element)->getCSSValue('clip-path'));

            $browser->keys($this->element, '{enter}')
                ->assertNotFocused($this->element)
                ->assertFragmentIs('kontourMain');
        });
    }
}
