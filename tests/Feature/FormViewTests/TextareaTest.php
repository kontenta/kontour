<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class TextareaTest extends IntegrationTest
{
    public function test_textarea_is_referenced_by_label()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<label\s*for="test"\s*>/', $output);
        $this->assertRegExp('/<textarea[\S\s]*id="test"\s*>/', $output);
    }

    public function test_textarea_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertRegExp('/<label\s*for="a"\s*>/', $output);
        $this->assertRegExp('/<textarea[\S\s]*id="a"\s*>/', $output);
    }

    public function test_textarea_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertRegExp('/<label\s*for="pre-test"\s*>/', $output);
        $this->assertRegExp('/<textarea[\S\s]*id="pre-test"\s*>/', $output);
    }

    public function test_default_value_is_empty_string()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<textarea[\S\s]*><\/textarea>/', $output);
    }

    public function test_old_value_is_not_used_if_no_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'old']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/<textarea[\S\s]*>old<\/textarea>/', $output);
    }

    public function test_old_value_is_used_if_in_session_with_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'old']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag(['another_field' => ['An error']]),
        ])->render();

        $this->assertRegExp('/<textarea[\S\s]*>old<\/textarea>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'value' => 'a',
            'slot' => 'b',
            'model' => ['test' => 'c'],
        ];

        while (count($fallbacks)) {
            $output = View::make('kontour::forms.textarea',
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
            $this->assertRegExp('/<textarea[\S\s]*>' . $value . '<\/textarea>/', $output);
        }
    }

    public function test_error_input_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertRegExp('/<textarea[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertRegExp('/<textarea[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus()
    {
        $output = View::make('kontour::forms.textarea', [
            'name' => 'test',
            'errors' => new MessageBag,
            'autofocusControlId' => 'test',
        ])->render();

        $this->assertRegExp('/<textarea[\S\s]*autofocus[\S\s]*>/', $output);
    }
}
