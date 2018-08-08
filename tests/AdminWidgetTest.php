<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Fakes\AdminWidget as FakeAdminWidget;
use Kontenta\Kontour\Contracts\AdminWidget as AdminWidgetContract;
use PHPUnit\Framework\TestCase;

final class AdminWidgetTest extends TestCase
{
    public function testInterface()
    {
        $adminWidget = new FakeAdminWidget();        
        $this->assertInstanceOf(AdminWidgetContract::class, $adminWidget);
    }
}
