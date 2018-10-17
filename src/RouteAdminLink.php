<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Facades\URL;

class RouteAdminLink extends AdminLink
{
    protected $routeName;
    protected $routeParameters;

    public function __construct(string $name, string $routeName, $routeParameters = [], string $description = null)
    {
        $this->name = $name;
        $this->routeName = $routeName;
        $this->routeParameters = $routeParameters;
        $this->withDescription($description);
    }

    public function getUrl(): ?string
    {
        try {
            return URL::route($this->routeName, $this->routeParameters);
        } catch (\Exception $e) {
            return null;
        }
    }
}
