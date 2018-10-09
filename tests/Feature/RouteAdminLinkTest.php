<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Kontenta\KontourSupport\RouteAdminLink;
use Kontenta\KontourSupport\Tests\IntegrationTest;

class RouteAdminLinkTest extends IntegrationTest
{
    public function test_url_is_null_when_route_does_not_exist()
    {
        $link = new RouteAdminLink('not.existing', 'Hej', '"Hejsanhejsan"');

        $this->assertNull($link->getUrl());
        $this->assertEquals('<a title="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }
}
