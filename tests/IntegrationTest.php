<?php

namespace Kontenta\Kontour\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Cache;

abstract class IntegrationTest extends TestCase
{
    use IntegrationTestSetupTrait;

    public function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }
}
