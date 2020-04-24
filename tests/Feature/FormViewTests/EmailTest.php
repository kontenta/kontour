<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class EmailTest extends IntegrationTest
{
    public function test_input_type_defaults_to_email()
    {
        $output = View::make('kontour::forms.email', [
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*type="email"[\S\s]*>/', $output);
    }

    public function test_input_type_can_be_specified()
    {
        $output = View::make('kontour::forms.email', [
            'errors' => new MessageBag,
            'type' => 'text',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*type="text"[\S\s]*>/', $output);
    }

    public function test_input_name_defaults_to_email()
    {
        $output = View::make('kontour::forms.email', [
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*name="email"[\S\s]*>/', $output);
    }

    public function test_input_name_can_be_specified()
    {
        $output = View::make('kontour::forms.email', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*name="test"[\S\s]*>/', $output);
    }
}
