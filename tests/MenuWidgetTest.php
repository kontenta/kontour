<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Fakes\MenuWidget as FakeMenuWidget;
use Kontenta\Kontour\Contracts\MenuWidget as MenuWidgetContract;
use PHPUnit\Framework\TestCase;

final class MenuWidgetTest extends TestCase
{
    public function testInterface()
    {
        $widget = new FakeMenuWidget();
        $this->assertInstanceOf(MenuWidgetContract::class, $widget);
    }
}
