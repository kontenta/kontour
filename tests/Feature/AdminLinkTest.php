<?php

namespace Kontenta\Kontour\Tests\Feature;

use Kontenta\Kontour\Tests\UserlandAdminToolTest;
use Kontenta\Kontour\AdminLink;

class AdminLinkTest extends UserlandAdminToolTest
{
    public function test_can_be_converted_to_html()
    {
        $link = new AdminLink('Hej', 'http://hej.com', '"Hejsanhejsan"');

        $this->assertEquals('<a href="http://hej.com" aria-label="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }

    public function test_description_can_be_added_fluently()
    {
        $link = new AdminLink('Hej', 'http://hej.com');
        $link = $link->withDescription('Hejsanhejsan');

        $this->assertEquals('<a href="http://hej.com" aria-label="Hejsanhejsan">Hej</a>', $link->toHtml());
    }

    public function test_can_be_created_statically()
    {
        $link = AdminLink::create('Hej', 'http://hej.com', 'Hejsanhejsan');

        $this->assertTrue($link instanceof AdminLink);
        $this->assertEquals('Hej', $link->getName());
        $this->assertEquals('http://hej.com', $link->getUrl());
        $this->assertEquals('Hejsanhejsan', $link->getDescription());
    }

    public function test_has_no_title()
    {
        $link = AdminLink::create('Hej', 'http://hej.com', 'Hejsanhejsan');

        $this->assertStringNotContainsString('title=', $link->toHtml());
    }

    public function test_has_label_with_description()
    {
        $link = AdminLink::create('Hej', 'http://hej.com', 'Hejsanhejsan');

        $this->assertStringContainsString('aria-label="Hejsanhejsan"', $link->toHtml());
    }

    public function test_has_no_label_without_description()
    {
        $link = AdminLink::create('Hej', 'http://hej.com');

        $this->assertStringNotContainsString('aria-label=', $link->toHtml());
    }

    public function test_name_and_description_are_combined_in_label()
    {
        $link = AdminLink::create('Ciao', 'http://hej.com', 'Hejdå');

        $this->assertRegExp('/aria-label="Ciao.*Hejdå"/', $link->toHtml());
    }

    public function test_name_is_not_repeated_in_label()
    {
        $link = AdminLink::create('Hej', 'http://hej.com', 'Hejdå');

        $this->assertStringContainsString('aria-label="Hejdå"', $link->toHtml());
    }

    public function test_name_words_are_not_repeated_in_label()
    {
        $link = AdminLink::create('Hej hej', 'http://hej.com', 'Hejdå');

        $this->assertStringContainsString('aria-label="Hejdå"', $link->toHtml());
    }

    public function test_with_different_view()
    {
        $link = new AdminLink('Hej', 'http://hej.com');
        $link = $link->withDescription('Hejsanhejsan');
        $link = $link->withView('userland::adminlink');

        $this->assertEquals('<a href="http://hej.com" title="Hejsanhejsan" class="link">Hej</a>', $link->toHtml());
    }
}
