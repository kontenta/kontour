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

        $this->assertMatchesRegularExpression('/<select[\S\s]*name="test\[]"[\S\s]*>/', $output);
    }

    public function test_multiselect_has_array_name_from_dot_notation()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test.name.in.dot.notation',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<select[\S\s]*name="test\[name]\[in]\[dot]\[notation]\[]"[\S\s]*>/', $output);
    }


    public function test_multiselect_has_hidden_presence_input()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<input type="hidden" name="test" value="">[\S\s]*<select[\S\s]*multiple[\S\s]*>/', $output);
    }

    public function test_multiselect_has_hidden_presence_input_from_dot_notation()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test.name.in.dot.notation',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<input type="hidden" name="test\[name]\[in]\[dot]\[notation]" value="">[\S\s]*<select[\S\s]*multiple[\S\s]*>/', $output);
    }

    public function test_select_is_referenced_by_label()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/<label\s*for="test"\s*>/', $output);
        $this->assertMatchesRegularExpression('/<select[\S\s]*id="test"\s*>/', $output);
    }

    public function test_select_can_have_custom_control_id()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'controlId' => 'a',
        ])->render();

        $this->assertMatchesRegularExpression('/<label\s*for="a"\s*>/', $output);
        $this->assertMatchesRegularExpression('/<select[\S\s]*id="a"\s*>/', $output);
    }

    public function test_select_can_have_id_prefix()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'idPrefix' => 'pre-',
        ])->render();

        $this->assertMatchesRegularExpression('/<label\s*for="pre-test"\s*>/', $output);
        $this->assertMatchesRegularExpression('/<select[\S\s]*id="pre-test"\s*>/', $output);
    }

    public function test_default_is_no_option_selected()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<option[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_option_can_be_selected()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => 'a',
        ])->render();

        $this->assertMatchesRegularExpression('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
        $this->assertDoesNotMatchRegularExpression('/<option[\S\s]*value="b"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_multiple_options_can_be_selected()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'selected' => ['a', 'b'],
        ])->render();

        $this->assertMatchesRegularExpression('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<option[\S\s]*value="b"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_optgroups()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B', 'A Group' => ['c' => 'C', 'd' => 'D']],
            'errors' => new MessageBag,
            'selected' => ['c', 'b'],
        ])->render();

        $this->assertEquals(2, preg_match_all('/\sselected\s/', $output), 'Not exactly two selected options');

        $tags = $this->splitHtmlTags($output);
        $this->assertStringContainsString('<select', $tags[4], 'Select tag is not in expected order');

        $optionB = $tags[6];
        $this->assertStringContainsString('value="b"', $optionB);
        $this->assertStringContainsString('selected', $optionB);

        $optgroup = $tags[7];
        $this->assertStringContainsString('<optgroup', $optgroup, 'Optgroup tag is not in expected order');
        $this->assertStringContainsString('label="A Group"', $optgroup);

        $optionC = $tags[8];
        $this->assertStringContainsString('value="c"', $optionC);
        $this->assertStringContainsString('selected', $optionC);
        $this->assertStringContainsString('>C<', $optionC);

        $optionD = $tags[9];
        $this->assertStringContainsString('value="d"', $optionD);
    }

    public function test_old_value_is_not_used_if_no_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_old_value_is_used_if_in_session_with_errors()
    {
        $this->withSession(['_old_input' => ['test' => 'a']]);
        request()->setLaravelSession(session());
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['another_field' => ['An error']]),
        ])->render();

        $this->assertMatchesRegularExpression('/<option[\S\s]*value="a"[\S\s]*selected[\S\s]*>/', $output);
    }

    public function test_fallback_values_are_used_in_order()
    {
        $fallbacks = [
            'selected' => 'a',
            'model' => ['test' => 'b'],
        ];

        while (count($fallbacks)) {
            $output = View::make(
                'kontour::forms.multiselect',
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
            $this->assertMatchesRegularExpression('/<option[\S\s]*value="' . $value . '"[\S\s]*selected[\S\s]*>/', $output);
        }
    }

    public function test_error_select_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
        ])->render();

        $this->assertMatchesRegularExpression('/<select[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_custom_errors_id_suffix()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test' => ['A message']]),
            'errorsSuffix' => '-errors',
        ])->render();

        $this->assertMatchesRegularExpression('/<select[\S\s]*aria-describedby="test-errors"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="test-errors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_error_on_option_referencing_error_element_with_errors()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag(['test.1' => 'A message']),
        ])->render();

        $this->assertMatchesRegularExpression('/<select[\S\s]*aria-describedby="testErrors"[\S\s]*>/', $output);
        $this->assertMatchesRegularExpression('/<(\S*)[\S\s]*id="testErrors"[\S\s]*>[\S\s]*A message[\S\s]*<\/\1>/', $output);
    }

    public function test_autofocus()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'autofocusControlId' => 'test',
        ])->render();

        $this->assertMatchesRegularExpression('/<select[\S\s]*autofocus[\S\s]*>/', $output);
    }

    public function test_options_can_be_disabled()
    {
        $output = View::make('kontour::forms.multiselect', [
            'name' => 'test',
            'options' => ['a' => 'A', 'b' => 'B'],
            'errors' => new MessageBag,
            'disabledOptions' => ['b'],
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/<option[^>]*value="a"[^>]*disabled[^>]*>/', $output);
        $this->assertMatchesRegularExpression('/<option[^>]*value="b"[^>]*disabled[^>]*>/', $output);
    }
}
