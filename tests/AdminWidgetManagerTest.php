<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Fakes\AdminWidgetManager as FakeAdminWidgetManager;
use Kontenta\Kontour\Contracts\AdminWidgetManager as AdminWidgetManagerContract;
use PHPUnit\Framework\TestCase;

final class AdminWidgetManagerTest extends TestCase
{
    public function testInterface()
    {
        $adminWidgetManager = new FakeAdminWidgetManager();        
        $this->assertInstanceOf(AdminWidgetManagerContract::class, $adminWidgetManager);
    }
}
