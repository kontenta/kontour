<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class InputTest extends IntegrationTest
{
    public function test_input_has_label()
    {
        $output = View::make('kontour::forms.input', ['name' => 'test', 'errors' => new MessageBag])->render();

        $this->assertRegExp('/<label\s*for="test"\s*>/', $output);
    }
}
