<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class InputAttributesTest extends IntegrationTest
{
    public function test_has_name()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/name="testName"\W/', $output);
    }

    public function test_name_in_dot_notation()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'test.name.in.dot.notation',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/name="test\[name]\[in]\[dot]\[notation]"\W/', $output);
    }

    public function test_has_control_id()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertMatchesRegularExpression('/\s+id="testId"\W/', $output);
    }

    public function test_aria_invalid_not_present_on_error_free_input()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/aria-invalid/', $output);
    }

    public function test_error_free_input_not_referencing_error_element()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/aria-describedby/', $output);
    }

    public function test_error_input_has_aria_invalid()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
        ])->render();

        $this->assertMatchesRegularExpression('/\s+aria-invalid="true"\W/', $output);
    }

    public function test_error_input_referencing_error_element()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
        ])->render();

        $this->assertMatchesRegularExpression('/\s+aria-describedby="errorsId"\W/', $output);
    }

    public function test_aria_describedby_can_be_set()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'controlAttributes' => ['aria-describedby' => 'descriptionId'],
        ])->render();

        $this->assertMatchesRegularExpression('/\s+aria-describedby="descriptionId"\W/', $output);
    }

    public function test_error_input_prepending_aria_describedby()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
            'controlAttributes' => ['aria-describedby' => 'descriptionId'],
        ])->render();

        $this->assertMatchesRegularExpression('/\s+aria-describedby="errorsId\sdescriptionId"\W/', $output);
    }

    public function test_control_attributes()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'controlAttributes' => [
                'a' => 'b',
                'boolean',
                'true' => true,
                'false' => false,
                'b' => 'false',
                'c' => 0,
            ],
        ])->render();

        $this->assertMatchesRegularExpression('/\s+a="b"\s+boolean\s+true\s+b="false"\s+c="0"\W/', $output);
        $this->assertDoesNotMatchRegularExpression('/\sfalse\W/', $output);
    }

    public function test_can_have_autofocus()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'autofocusControlId' => 'testId',
        ])->render();

        $this->assertMatchesRegularExpression('/\s+autofocus\W/', $output);
    }

    public function test_other_element_can_have_autofocus()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'autofocusControlId' => 'otherId',
        ])->render();

        $this->assertDoesNotMatchRegularExpression('/autofocus/', $output);
    }

    public function test_can_have_placeholder()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'placeholder' => 'Placeholder text',
        ])->render();

        $this->assertMatchesRegularExpression('/\s+placeholder="Placeholder text"\W/', $output);
    }
}
