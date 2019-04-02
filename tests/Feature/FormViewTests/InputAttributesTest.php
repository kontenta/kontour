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

        $this->assertRegExp('/name="testName"/', $output);
    }

    public function test_name_in_dot_notation()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'test.name.in.dot.notation',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/name="test\[name]\[in]\[dot]\[notation]"/', $output);
    }

    public function test_has_control_id()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertRegExp('/id="testId"/', $output);
    }

    public function test_aria_invalid_not_present_on_error_free_input()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/aria-invalid/', $output);
    }

    public function test_error_free_input_not_referencing_error_element()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/aria-describedby/', $output);
    }

    public function test_error_input_has_aria_invalid()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
        ])->render();

        $this->assertRegExp('/aria-invalid="true"/', $output);
    }

    public function test_error_input_referencing_error_element()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
        ])->render();

        $this->assertRegExp('/aria-describedby="errorsId"/', $output);
    }

    public function test_aria_describedby_can_be_set()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'ariaDescribedById' => 'descriptionId',
        ])->render();

        $this->assertRegExp('/aria-describedby="descriptionId"/', $output);
    }

    public function test_error_input_overwriting_aria_describedby()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
            'ariaDescribedById' => 'descriptionId',
        ])->render();

        $this->assertRegExp('/aria-describedby="errorsId"/', $output);
        $this->assertNotRegExp('/aria-describedby="descriptionId"/', $output);
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

        $this->assertRegExp('/a="b"\s*boolean\s*true\s*b="false"\s*c="0"/', $output);
        $this->assertNotRegExp('/\sfalse\s/', $output);
    }

    public function test_can_have_autofocus()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'autofocusControlId' => 'testId',
        ])->render();

        $this->assertRegExp('/autofocus/', $output);
    }

    public function test_other_element_can_have_autofocus()
    {
        $output = View::make('kontour::forms.partials.inputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
            'autofocusControlId' => 'otherId',
        ])->render();

        $this->assertNotRegExp('/autofocus/', $output);
    }
}
