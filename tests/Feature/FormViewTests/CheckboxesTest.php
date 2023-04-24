<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class CheckboxesTest extends IntegrationTest
{
    public function test_checkboxes_has_array_name()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*name="test\[]"[\S\s]*>/', $output);
    }

    public function test_checkboxes_has_array_name_from_dot_notation()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test.name.in.dot.notation',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*name="test\[name]\[in]\[dot]\[notation]\[]"[\S\s]*>/', $output);
    }

    public function test_checkboxes_has_hidden_presence_input()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<input type="hidden" name="test" value="">[\S\s]*<input[\S\s]*type="checkbox"[\S\s]*>/', $output);
    }

    public function test_checkboxes_has_hidden_presence_input_from_dot_notation()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test.name.in.dot.notation',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<input type="hidden" name="test\[name]\[in]\[dot]\[notation]" value="">[\S\s]*<input[\S\s]*type="checkbox"[\S\s]*>/', $output);
    }

    public function test_fieldset_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertMatchesRegularExpression('/<fieldset[\S\s]*id="a"[\S\s]*>/', $output);
    }

    public function test_fieldset_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertMatchesRegularExpression('/<fieldset[\S\s]*id="pre-test"[\S\s]*>/', $output);
    }

    public function test_default_is_no_checkbox_selected()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<input[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_checkbox_can_be_selected()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => 'a',
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_multiple_checkboxes_can_be_selected()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => ['a', 'b'],
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<input[\S\s]*value="b"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_groups()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B', 'A Group' => ['c' => 'C', 'd' => 'D']],
            'errors' => new MessageBag,
            'selected' => ['c', 'b'],
        ])->render();

        $this->assertMatchesRegularExpression('/<fieldset[^>]*>[\S\s]*<input[^>]*value="a"[^>]*>A[\S\s]*<input[^>]*value="b"\s*checked[^>]*>B[\S\s]*<fieldset[^>]*>\s*<legend>A Group<\/legend>[\S\s]*<input[^>]*value="c"\s*checked[^>]*>C[\S\s]*<input[^>]*value="d"[^>]*>D[\S\s]*<\/fieldset>[\S\s]*<\/fieldset>/', $output);
    }

    public function test_old_value_is_not_used_if_no_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_old_value_is_used_if_in_session_with_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['another_field' => ['An error']]),
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'selected' => 'a',
            'model' => ['test' => 'b'],
        ];

        while (count($fallbacks)) {
            $output = View::make('kontour::forms.checkboxes',
                array_merge(
                    [
                        'name' => 'test',
                        'options' => ['a' => 'A', 'b' => 'B'],
                        'errors' => new MessageBag,
                    ],
                    $fallbacks
                )
            )->render();

            $value = array_shift($fallbacks);
            if (is_array($value)) {
                $value = $value['test'];
            }
            $this->assertMatchesRegularExpression('/<input[\S\s]*value="' . $value . '"[\S\s]*checked[\S\s]*>/', $output);
        }
    }

    public function test_error_checkboxes_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_error_option_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag([
                'test.1' => ['Error for option'],
                'test' => ['A message'],
            ]),
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*aria-describedby="testErrors\.1"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="testErrors\.1"[\S\s]*>[\S\s]*Error for option[\S\s]*<\/\1>/', $output);

        $this->assertMatchesRegularExpression('/<input[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus_on_first_option()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'autofocusControlId' => 'test',
        ])->render();

        $this->assertMatchesRegularExpression('/<input[\S\s]*id="test\.0"[\S\s]*autofocus[\S\s]*>/', $output);
        $this->assertDoesNotMatchRegularExpression('/<input[\S\s]*id="test\.1"[\S\s]*autofocus[\S\s]*>/', $output);
    }

    public function test_autofocus_on_specific_option()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'autofocusControlId' => 'test.1',
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<input[\S\s]*id="test\.0"[\S\s]*autofocus[\S\s]*>[\S\s]*<input/', $output);
        $this->assertMatchesRegularExpression('/<input[\S\s]*id="test\.1"[\S\s]*autofocus[\S\s]*>/', $output);
    }

    public function test_checkboxes_can_be_disabled()
    {
        $output = View::make('kontour::forms.checkboxes', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'disabledOptions' => ['b'],
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<input[^>]*value="a"[^>]*disabled[^>]*>/', $output);
        $this->assertMatchesRegularExpression('/<input[^>]*value="b"[^>]*disabled[^>]*>/', $output);
    }
}
