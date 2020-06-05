<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Kontenta\Kontour\Contracts\AdminWidget;

class UserlandAdminWidget implements AdminWidget
{
    public function toHtml()
    {
        return <<<EOT
            <section>
                <header>Userland Widget</header>
                <button class="button-destructive">Danger Zone</button>
            </section>
EOT;
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
