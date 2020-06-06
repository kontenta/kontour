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
            $browser->loginAs($this->user, 'admin')->visit(route('userland.index'));

            $browser
                ->resize(1024, 768)
                ->screenshot('docs/userlandtool');
        });
    }
}
