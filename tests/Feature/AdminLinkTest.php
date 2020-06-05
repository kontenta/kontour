<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Tests\IntegrationTest;
use Kontenta\Kontour\Tests\UserlandTestSetupTrait;

class AdminLinkTest extends IntegrationTest
{
    use UserlandTestSetupTrait;

    public function test_can_be_converted_to_html()
    {
        $link = new AdminLink('Hej', 'http://hej.com', '"Hejsanhejsan"');

        $this->assertEquals('<a href="http://hej.com" title="&quot;Hejsanhejsan&quot;" aria-label="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }

    public function test_description_can_be_added_fluently()
    {
        $link = new AdminLink('Hej', 'http://hej.com');
        $link = $link->withDescription('Hejsanhejsan');

        $this->assertEquals('<a href="http://hej.com" title="Hejsanhejsan" aria-label="Hejsanhejsan">Hej</a>', $link->toHtml());
    }

    public function test_can_be_created_statically()
    {
        $link = AdminLink::create('Hej', 'http://hej.com', 'Hejsanhejsan');

        $this->assertTrue($link instanceof AdminLink);
        $this->assertEquals('Hej', $link->getName());
        $this->assertEquals('http://hej.com', $link->getUrl());
        $this->assertEquals('Hejsanhejsan', $link->getDescription());
    }

    public function test_with_different_view()
    {
        $link = new AdminLink('Hej', 'http://hej.com');
        $link = $link->withDescription('Hejsanhejsan');
        $link = $link->withView('userland::adminlink');

        $this->assertEquals('<a href="http://hej.com" title="Hejsanhejsan" class="link">Hej</a>', $link->toHtml());
    }
}
