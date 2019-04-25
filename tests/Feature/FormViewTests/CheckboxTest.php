<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class CheckboxTest extends IntegrationTest
{
    public function test_input_is_referenced_by_label()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<label\s*for="test"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="test"\s*>/', $output);
    }

    public function test_input_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertRegExp('/<label\s*for="a"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="a"\s*>/', $output);
    }

    public function test_input_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertRegExp('/<label\s*for="pre-test"\s*>/', $output);
        $this->assertRegExp('/<input[\S\s]*id="pre-test"\s*>/', $output);
    }

    public function test_default_is_not_checked()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/<input[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_can_be_checked()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
            'checked' => true,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_default_value_is_1()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value="1"[\S\s]*>/', $output);
    }

    public function test_default_value_can_be_set()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
            'checkboxDefaultValue' => 2,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value="2"[\S\s]*>/', $output);
    }

    public function test_value_can_be_set()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
            'value' => 3,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value="3"[\S\s]*>/', $output);
    }

    public function test_old_value_is_used_if_in_session()
    {
        $this->withSession(['_old_input' => ['test' => true]]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'checked' => false,
            'model' => ['test' => true],
        ];

        while (count($fallbacks)) {
            $output = View::make('kontour::forms.checkbox',
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
            $regexp = '/<input[\S\s]*checked[\S\s]*>/';
            if($value) {
                $this->assertRegExp($regexp, $output);
            } else {
                $this->assertNotRegExp($regexp, $output);
            }
        }
    }

    public function test_error_input_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus()
    {
        $output = View::make('kontour::forms.checkbox', [
            'name' => 'test',
            'errors' => new MessageBag,
            'autofocusControlId' => 'test',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*autofocus[\S\s]*>/', $output);
    }
}
