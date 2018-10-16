<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\Contracts\MenuWidget;
use Kontenta\Kontour\Contracts\AdminLink;

trait RegistersMenuWidgetLinks
{
    public function addMenuWidgetLink(AdminLink $link, string $desiredHeading = null)
    {
        $this->resolveMenuWidget()->addLink($link, $desiredHeading);
    }

    protected function resolveMenuWidget(): MenuWidget
    {
        return app(MenuWidget::class);
    }
}
