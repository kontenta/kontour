<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use Kontenta\Kontour\Contracts\MenuWidget;

//TODO: remove this trait alltogether
trait RegistersMenuWidgetLinks
{
    public function addMenuWidgetUrl(string $name, string $url, string $desiredHeading = null): AdminLink
    {
        return $this->addMenuWidgetAdminLink(AdminLink::create($name, $url), $desiredHeading);
    }

    public function addMenuWidgetAdminLink(AdminLinkContract $link, string $desiredHeading = null): AdminLinkContract
    {
        $this->resolveMenuWidget()->addLink($link, $desiredHeading);

        return $link;
    }

    protected function resolveMenuWidget(): MenuWidget
    {
        return app(MenuWidget::class);
    }
}
