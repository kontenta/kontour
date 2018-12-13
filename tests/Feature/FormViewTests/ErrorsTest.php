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
}
