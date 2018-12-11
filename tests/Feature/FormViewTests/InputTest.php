<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class InputTest extends IntegrationTest
{
    public function test_input_type_defaults_to_text()
    {
        $output = View::make('kontour::forms.input', ['name' => 'test', 'errors' => new MessageBag])->render();

        $this->assertRegExp('/<input[\S\s]*type="text"[\S\s]*>/', $output);
    }

    public function test_input_is_referenced_by_label()
    {
        $output = View::make('kontour::forms.input', ['name' => 'test', 'errors' => new MessageBag])->render();

        $this->assertRegExp('/<label\s*for="test"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="test"\s*>/', $output);
    }

    public function test_input_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.input', ['name' => 'test', 'errors' => new MessageBag, 'controlId' => 'a'])->render();

        $this->assertRegExp('/<label\s*for="a"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="a"\s*>/', $output);
    }

    public function test_input_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.input', ['name' => 'test', 'errors' => new MessageBag, 'idPrefix' => 'pre-'])->render();

        $this->assertRegExp('/<label\s*for="pre-test"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="pre-test"\s*>/', $output);
    }
}
