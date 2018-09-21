<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\ShowAdminVisit;
use Kontenta\Kontour\Tests\Fakes\AdminLink;
use Kontenta\Kontour\Tests\Fakes\AdminUser;
use Kontenta\Kontour\Events\AdminToolVisited;
use PHPUnit\Framework\TestCase;

final class EventTest extends TestCase
{
    public function testAdminToolVisitedEvent()
    {
        $event = new AdminToolVisited(new ShowAdminVisit(new AdminLink(), new AdminUser()));
        $this->assertInstanceOf(AdminToolVisited::class, $event);
    }
}

