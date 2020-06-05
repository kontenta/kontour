<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Feature\Fakes\UserlandAppServiceProvider;
use Kontenta\Kontour\Tests\Feature\Fakes\UserlandServiceProvider;

trait UserlandTestSetupTrait
{
    protected function getPackageProviders($app)
    {
        return array_merge([UserlandAppServiceProvider::class, UserlandServiceProvider::class], parent::getPackageProviders($app));
    }
}
