<?php

namespace Kontenta\Kontour\Tests\Unit;

use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Tests\UnitTest;

class AdminLinkTest extends UnitTest
{
    public function test_can_be_converted_to_html()
    {
        $link = new AdminLink('Hej', 'http://hej.com', '"Hejsanhejsan"');

        $this->assertEquals('<a href="http://hej.com" title="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }
}
