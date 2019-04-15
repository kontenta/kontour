<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class MultiselectTest extends IntegrationTest
{
    public function test_multiselect_has_array_name()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<select[\S\s]*name="test\[]"[\S\s]*>/', $output);
    }

    public function test_multiselect_has_hidden_presence_input()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<input type="hidden" name="test" value="">[\S\s]*<select[\S\s]*multiple[\S\s]*>/', $output);
    }

    public function test_select_is_referenced_by_label()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<label\s*for="test"\s*>/', $output);
        $this->assertRegExp('/<select[\S\s]*id="test"\s*>/', $output);
    }

    public function test_select_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertRegExp('/<label\s*for="a"\s*>/', $output);
        $this->assertRegExp('/<select[\S\s]*id="a"\s*>/', $output);
    }

    public function test_select_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertRegExp('/<label\s*for="pre-test"\s*>/', $output);
        $this->assertRegExp('/<select[\S\s]*id="pre-test"\s*>/', $output);
    }

    public function test_default_is_no_option_selected()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/<option[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_option_can_be_selected()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => 'a',
        ])->render();

        $this->assertRegExp('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
        $this->assertNotRegExp('/<option[\S\s]*value="b"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_multiple_options_can_be_selected()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => ['a', 'b'],
        ])->render();

        $this->assertRegExp('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
        $this->assertRegExp('/<option[\S\s]*value="b"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_optgroups()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B', 'A Group' => ['c' => 'C', 'd' => 'D']],
            'errors' => new MessageBag,
            'selected' => ['c', 'b'],
        ])->render();

        $this->assertRegExp('/<select[\S\s]*>\s*<option\s*value="a"\s*>A<\/option>\s*<option\s*value="b"\s*selected\s*>B<\/option>\s*<optgroup\s*label="A Group">\s*<option\s*value="c"\s*selected\s*>C<\/option>\s*<option\s*value="d"\s*>D<\/option>\s*<\/optgroup>\s*<\/select>/', $output);
    }

    public function test_old_value_is_used_if_in_session()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'selected' => 'a',
            'model' => ['test' => 'b'],
        ];

        while (count($fallbacks)) {
            $output = View::make('kontour::forms.multiselect',
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
            $this->assertRegExp('/<option[\S\s]*value="' . $value . '"[\S\s]*selected[\S\s]*>/', $output);
        }
    }

    public function test_error_select_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertRegExp('/<select[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertRegExp('/<select[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_error_on_option_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test.1' => 'A message']),
        ])->render();

        $this->assertRegExp('/<select[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertRegExp('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'autofocusControlId' => 'test',
        ])->render();

        $this->assertRegExp('/<select[\S\s]*autofocus[\S\s]*>/', $output);
    }

    public function test_options_can_be_disabled()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'disabledOptions' => ['b'],
        ])->render();

        $this->assertNotRegExp('/<option[^>]*value="a"[^>]*disabled[^>]*>/', $output);
        $this->assertRegExp('/<option[^>]*value="b"[^>]*disabled[^>]*>/', $output);
    }
}
