<?php

namespace Kontenta\KontourSupport;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RouteAdminLink extends AdminLink
{
    protected $routeName;

    public function __construct(string $routeName, string $name, string $description = null)
    {
        $this->routeName = $routeName;
        $this->name = $name;
        $this->description = $description;
    }

    public function getUrl(): ?string
    {
        return Route::has($this->routeName) ? URL::route($this->routeName) : null;
    }
}
