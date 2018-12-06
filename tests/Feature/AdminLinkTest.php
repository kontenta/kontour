<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\Tests\IntegrationTest;
use Kontenta\Kontour\AdminLink;

class AdminLinkTest extends IntegrationTest
{
    public function test_can_be_converted_to_html()
    {
        $link = new AdminLink('Hej', 'http://hej.com', '"Hejsanhejsan"');

        $this->assertEquals('<a href="http://hej.com" title="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }

    public function test_description_can_be_added_fluently()
    {
        $link = new AdminLink('Hej', 'http://hej.com');
        $link = $link->withDescription('Hejsanhejsan');

        $this->assertEquals('<a href="http://hej.com" title="Hejsanhejsan">Hej</a>', $link->toHtml());
    }

    public function test_can_be_created_statically()
    {
        $link = AdminLink::create('Hej', 'http://hej.com', 'Hejsanhejsan');

        $this->assertTrue($link instanceof AdminLink);
        $this->assertEquals('Hej', $link->getName());
        $this->assertEquals('http://hej.com', $link->getUrl());
        $this->assertEquals('Hejsanhejsan', $link->getDescription());
    }
}
