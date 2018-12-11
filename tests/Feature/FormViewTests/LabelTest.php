<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class LabelTest extends IntegrationTest
{
    public function test_input_label_is_humanized()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test_input', 'errors' => new MessageBag])->render();

        $this->assertRegExp('/<label[\S\s]*>Test input<\/label>/', $output);
    }
}
