<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Fakes\UrlVisit;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\Events\AdminToolShowVisited;
use Kontenta\Kontour\Events\AdminToolEditVisited;
use PHPUnit\Framework\TestCase;

final class EventTest extends TestCase
{
    public function testShowEvent()
    {
        $event = new AdminToolShowVisited(new UrlVisit());
        $this->assertInstanceOf(AdminToolVisited::class, $event);
    }

    public function testEditEvent()
    {
        $event = new AdminToolEditVisited(new UrlVisit());
        $this->assertInstanceOf(AdminToolVisited::class, $event);
    }
}

