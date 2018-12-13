<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class InputAttributesTest extends IntegrationTest
{
    public function test_aria_invalid_not_present_on_error_free_input()
    {
        $output = View::make('kontour::forms.partials.InputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/aria-invalid/', $output);
    }

    public function test_error_free_input_not_referencing_error_element()
    {
        $output = View::make('kontour::forms.partials.InputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag,
        ])->render();

        $this->assertNotRegExp('/aria-describedby/', $output);
    }

    public function test_error_input_has_aria_invalid()
    {
        $output = View::make('kontour::forms.partials.InputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
        ])->render();

        $this->assertRegExp('/aria-invalid="true"/', $output);
    }

    public function test_error_input_referencing_error_element()
    {
        $output = View::make('kontour::forms.partials.InputAttributes', [
            'name' => 'testName',
            'controlId' => 'testId',
            'errors' => new MessageBag(['testName' => ['A message']]),
            'errorsId' => 'errorsId',
        ])->render();

        $this->assertRegExp('/aria-describedby="errorsId"/', $output);
    }
}
