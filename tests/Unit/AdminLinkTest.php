<?php

namespace Kontenta\Kontour\Tests\Unit;

use Kontenta\Kontour\Tests\UnitTest;
use Kontenta\Kontour\AdminLink;

class AdminLinkTest extends UnitTest
{
    public function test_can_be_converted_to_html()
    {
        $link = new AdminLink('http://hej.com', 'Hej', '"Hejsanhejsan"');

        $this->assertEquals('<a href="http://hej.com" title="&quot;Hejsanhejsan&quot;">Hej</a>', $link->toHtml());
    }
}
