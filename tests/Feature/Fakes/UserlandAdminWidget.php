<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Kontenta\Kontour\Contracts\AdminWidget;

class UserlandAdminWidget implements AdminWidget
{
    public function toHtml()
    {
        return <<<EOT
            <section data-kontour-widget="userlandWidget">
                <header>Userland Widget</header>
                <em>Highway to the&hellip;</em>
                <button class="button-destructive">Danger Zone</button>
            </section>
EOT;
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
