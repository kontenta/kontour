<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\RouteAdminLink;
use Kontenta\Kontour\Tests\IntegrationTest;

class RouteAdminLinkTest extends IntegrationTest
{
    public function test_url_is_null_when_route_does_not_exist()
    {
        $link = new RouteAdminLink('Hej', 'not.existing', '"Hejsanhejsan"');

        $this->assertNull($link->getUrl());
        $this->assertEquals('<a title="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }
}
