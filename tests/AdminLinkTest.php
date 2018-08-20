<?php

namespace Kontenta\Kontour\Tests;

use Kontenta\Kontour\Tests\Fakes\AdminLink as FakeAdminLink;
use Kontenta\Kontour\Contracts\AdminLink as AdminLinkContract;
use PHPUnit\Framework\TestCase;

final class AdminLinkTest extends TestCase
{
    public function testInterface()
    {
        $adminLink = new FakeAdminLink();        
        $this->assertInstanceOf(AdminLinkContract::class, $adminLink);
    }
}
