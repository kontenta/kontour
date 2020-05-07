<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class EmailTest extends IntegrationTest
{
    public static $defaultEmailAttributes = [
        'autocomplete' => 'email',
        'autocapitalize' => 'none',
        'autocorrect' => 'off',
    ];

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

    public function test_email_input_has_default_attributes()
    {
        $output = View::make('kontour::forms.email', [
            'errors' => new MessageBag,
        ])->render();

        foreach (self::$defaultEmailAttributes as $attribute => $default) {
            $this->assertStringContainsString("$attribute=\"$default\"", $output);
        }
    }

    public function test_control_attributes_can_be_set()
    {
        $output = View::make('kontour::forms.email', [
            'errors' => new MessageBag,
            'controlAttributes' => [
                'autocomplete' => 'off',
                'autocapitalize' => 'on',
                'autocorrect' => 'on',
                'required',
                'a' => 'b',
            ]
        ])->render();

        $this->assertRegExp('/\s+autocomplete="off"\W/', $output);
        $this->assertRegExp('/\s+autocapitalize="on"\W/', $output);
        $this->assertRegExp('/\s+autocorrect="on"\W/', $output);
        $this->assertRegExp('/\s+required\W/', $output);
        $this->assertRegExp('/\s+a="b"\W/', $output);

        foreach (self::$defaultEmailAttributes as $attribute => $default) {
            $this->assertStringNotContainsString("$attribute=\"$default\"", $output);
        }
    }
}
