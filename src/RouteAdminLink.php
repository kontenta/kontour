<?php

namespace Kontenta\KontourSupport;

class RouteAdminLink extends AdminLink
{
    protected $routeName;

    public function __construct(string $routeName, string $name, string $description = '')
    {
        $this->routeName = $routeName;
        $this->name = $name;
        $this->description = $description;
    }

    public function getUrl(): string
    {
        return route($this->routeName);
    }
}
