<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class ErrorsTest extends IntegrationTest
{
    public function test_empty_when_no_errors()
    {
        $output = View::make('kontour::forms.partials.errors', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertEquals($output, '');
    }

    public function test_errors_are_printed()
    {
        $output = View::make('kontour::forms.partials.errors', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['Error 1', 'Error 2'] ]),
            'errorsId' => 'errors',
        ])->render();

        $this->assertRegExp('/<(\S*)[\S\s]*id="errors"[\S\s]*>[\S\s]*Error 1[\S\s]*Error 2[\S\s]*<\/\1>/', $output);
    }
}
