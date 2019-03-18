<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class InputTest extends IntegrationTest
{
    public function test_input_type_defaults_to_text()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*type="text"[\S\s]*>/', $output);
    }

    public function test_input_type_can_be_specified()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
            'type' => 'email',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*type="email"[\S\s]*>/', $output);
    }

    public function test_input_is_referenced_by_label()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<label\s*for="test"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="test"\s*>/', $output);
    }

    public function test_input_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertRegExp('/<label\s*for="a"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="a"\s*>/', $output);
    }

    public function test_input_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertRegExp('/<label\s*for="pre-test"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="pre-test"\s*>/', $output);
    }

    public function test_value_attribute_is_not_present_on_password_inputs()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
            'type' => 'password',
            'value' => 'secret',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*type="password"[\S\s]*>/', $output);
        $this->assertNotRegExp('/<input[\S\s]*value="[^"]*"[\S\s]*>/', $output);
    }

    public function test_default_value_is_empty_string()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value=""[\S\s]*>/', $output);
    }

    public function test_old_value_is_used_if_in_session()
    {
        $this->withSession(['_old_input' => ['test' => 'old']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value="old"[\S\s]*>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'value' => 'a',
            'slot' => 'b',
            'model' => ['test' => 'c'],
        ];

        while (count($fallbacks)) {
            $output = View::make('kontour::forms.input',
                array_merge(
                    [
                        'name' => 'test',
                        'errors' => new MessageBag,
                    ],
                    $fallbacks
                )
            )->render();

            $value = array_shift($fallbacks);
            if (is_array($value)) {
                $value = $value['test'];
            }
            $this->assertRegExp('/<input[\S\s]*value="' . $value . '"[\S\s]*>/', $output);
        }
    }

    public function test_error_input_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_dot_notation_error_input_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test.dot.notation',
            'errors' => new MessageBag(['test.dot.notation' => ['A message']]),
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="test.dot.notationErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="test.dot.notationErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus()
    {
        $output = View::make('kontour::forms.input', [
            'name' => 'test',
            'errors' => new MessageBag,
            'autofocusInputName' => 'test',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*autofocus[\S\s]*>/', $output);
    }
}
