<?php

namespace Kontenta\Kontour;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RouteAdminLink extends AdminLink
{
    protected $routeName;

    public function __construct(string $name, string $routeName, string $description = null)
    {
        $this->name = $name;
        $this->routeName = $routeName;
        $this->description = $description;
    }

    public function getUrl(): ?string
    {
        return Route::has($this->routeName) ? URL::route($this->routeName) : null;
    }
}
