<?php

namespace Kontenta\Kontour\Tests\Browser;

use Kontenta\Kontour\Tests\DuskTest;
use Laravel\Dusk\Browser;

class ConfirmLeavePageTest extends DuskTest
{
    /**
     * Dispatch a synthetic beforeunload event and return handler results.
     *
     * Note: The W3C WebDriver spec (Section 16) mandates that beforeunload
     * dialogs are suppressed for HTTP-only sessions ("implementations must act
     * as if showing an unload prompt is likely to be annoying, deceptive, or
     * pointless"). Since Laravel Dusk uses classic HTTP WebDriver sessions,
     * we cannot test the actual browser dialog. Instead, we verify that the
     * beforeunload handler in confirm-leave-page.js correctly:
     * - calls event.preventDefault()
     * - sets event.returnValue
     * - sets the data-kontour-unload-prevented attribute on <body>
     */
    private function dispatchBeforeUnload(Browser $browser): array
    {
        return $browser->script("
            var e = new Event('beforeunload', {cancelable: true});
            var capturedReturnValue = null;
            Object.defineProperty(e, 'returnValue', {
                set: function(v) { capturedReturnValue = v; },
                get: function() { return capturedReturnValue; }
            });
            window.dispatchEvent(e);
            return JSON.stringify({
                defaultPrevented: e.defaultPrevented,
                returnValue: capturedReturnValue,
                unloadPrevented: document.body.getAttribute('data-kontour-unload-prevented')
            });
        ");
    }

    public function test_no_confirm_leave()
    {
        $this->browse(function (Browser $browser) {
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->visit('/')
                ->assertPathIs('/');
        });
    }

    public function test_no_beforeunload_prevention_without_changes()
    {
        $this->browse(function (Browser $browser) {
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl());

            $result = json_decode($this->dispatchBeforeUnload($browser)[0], true);

            $this->assertFalse($result['defaultPrevented'], 'beforeunload should not be prevented without dirty inputs');
            $this->assertNull(
                $result['unloadPrevented'],
                'data-kontour-unload-prevented should not be set without dirty inputs'
            );
        });
    }

    public function test_confirm_leave_after_changes()
    {
        $this->browse(function (Browser $browser) {
            $routeManager = $this->app->make(\Kontenta\Kontour\Contracts\AdminRouteManager::class);
            $browser->visit($routeManager->loginUrl())
                ->type('email', $this->user->email)
                ->waitFor('[data-kontour-dirty="true"]');

            $result = json_decode($this->dispatchBeforeUnload($browser)[0], true);

            $this->assertTrue($result['defaultPrevented'], 'beforeunload should be prevented when inputs are dirty');
            $this->assertEquals(
                'You have unsaved changes.',
                $result['returnValue'],
                'event.returnValue should contain the warning message'
            );
            $this->assertEquals(
                'true',
                $result['unloadPrevented'],
                'data-kontour-unload-prevented should be set on body'
            );
        });
    }
}
