<?php

namespace Kontenta\Kontour\Tests\Browser;

use Kontenta\Kontour\Tests\DuskTest;
use Kontenta\Kontour\Tests\UserlandTestSetupTrait;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\Gate;

class UserlandToolTest extends DuskTest
{
    use UserlandTestSetupTrait;

    /**
     * @throws \Exception
     * @throws \Throwable
     */
    public function test_userland_tool()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->user, 'admin');

            $browser->visit(route('userland.index'))
                ->resize(1024, 768)
                ->screenshot('docs/userlandindex');

            $browser->visit(route('userland.edit', 1))
                ->resize(1024, 768)
                ->screenshot('docs/userlandedit');
        });
    }
}
