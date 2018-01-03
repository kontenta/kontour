<?php

namespace Erik\AdminManagerImplementation\Tests\Feature\Fakes;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class UserlandServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        Route::group([
            'prefix' => 'userland-tool',
            'namespace' => 'Erik\AdminManagerImplementation\Tests\Feature\Fakes'
        ], function () {
            Route::get('/', 'UserlandController@index')->name('userland.index');
        });
    }
}
