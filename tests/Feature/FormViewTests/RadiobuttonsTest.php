<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class RadiobuttonsTest extends IntegrationTest
{
    public function test_fieldset_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertRegExp('/<fieldset[\S\s]*id="a"[\S\s]*>/', $output);
    }

    public function test_fieldset_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertRegExp('/<fieldset[\S\s]*id="pre-test"[\S\s]*>/', $output);
    }

    public function test_default_is_no_radio_selected()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/<input[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_radio_can_be_selected()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => 'a',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_groups()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B', 'A Group' => ['c' => 'C', 'd' => 'D']],
            'errors' => new MessageBag,
            'selected' => 'c',
        ])->render();

        $this->assertRegExp('/<fieldset[^>]*>[\S\s]*<input[^>]*value="a"[^>]*>A[\S\s]*<input[^>]*value="b"[^>]*>B[\S\s]*<fieldset[^>]*>\s*<legend>A Group<\/legend>[\S\s]*<input[^>]*value="c"\s*checked[^>]*>C[\S\s]*<input[^>]*value="d"[^>]*>D[\S\s]*<\/fieldset>[\S\s]*<\/fieldset>/', $output);
    }

    public function test_old_value_is_not_used_if_no_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_old_value_is_used_if_in_session_with_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['another_field' => ['An error']]),
        ])->render();

        $this->assertRegExp('/<input[\S\s]*value="a"[\S\s]*checked[\S\s]*>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'selected' => 'a',
            'model' => ['test' => 'b'],
        ];

        while (count($fallbacks)) {
            $output = View::make('kontour::forms.radiobuttons',
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
            $this->assertRegExp('/<input[\S\s]*value="' . $value . '"[\S\s]*checked[\S\s]*>/', $output);
        }
    }

    public function test_error_radiobuttons_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus_on_first_option()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'autofocusControlId' => 'test',
        ])->render();

        $this->assertRegExp('/<input[\S\s]*id="test\.0"[\S\s]*autofocus[\S\s]*>/', $output);
        $this->assertNotRegExp('/<input[\S\s]*id="test\.1"[\S\s]*autofocus[\S\s]*>/', $output);
    }

    public function test_autofocus_on_specific_option()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'autofocusControlId' => 'test.1',
        ])->render();

        $this->assertNotRegExp('/<input[\S\s]*id="test\.0"[\S\s]*autofocus[\S\s]*>[\S\s]*<input/', $output);
        $this->assertRegExp('/<input[\S\s]*id="test\.1"[\S\s]*autofocus[\S\s]*>/', $output);
    }

    public function test_radiobuttons_can_be_disabled()
    {
        $output = View::make('kontour::forms.radiobuttons', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'disabledOptions' => ['b'],
        ])->render();

        $this->assertNotRegExp('/<input[^>]*value="a"[^>]*disabled[^>]*>/', $output);
        $this->assertRegExp('/<input[^>]*value="b"[^>]*disabled[^>]*>/', $output);
    }
}
