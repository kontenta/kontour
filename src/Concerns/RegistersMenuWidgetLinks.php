<?php

namespace Kontenta\Kontour\Concerns;

use Kontenta\Kontour\AdminLink as UrlAdminLink;
use Kontenta\Kontour\Contracts\AdminLink;
use Kontenta\Kontour\Contracts\MenuWidget;
use Kontenta\Kontour\RouteAdminLink;

trait RegistersMenuWidgetLinks
{
    public function addMenuWidgetUrl(string $url, string $name, string $description = null, string $desiredHeading = null)
    {
        $link = new UrlAdminLink($name, $url, $description);
        $this->addMenuWidgetAdminLink($link, $desiredHeading);
    }

    public function addMenuWidgetRoute(string $routeName, string $name, string $description = null, string $desiredHeading = null)
    {
        $link = new RouteAdminLink($name, $routeName, $description);
        $this->addMenuWidgetAdminLink($link, $desiredHeading);
    }

    public function addMenuWidgetAdminLink(AdminLink $link, string $desiredHeading = null)
    {
        $this->resolveMenuWidget()->addLink($link, $desiredHeading);
    }

    protected function resolveMenuWidget(): MenuWidget
    {
        return app(MenuWidget::class);
    }
}
