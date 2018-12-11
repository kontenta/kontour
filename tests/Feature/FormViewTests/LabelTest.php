<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Kontenta\Kontour\Tests\IntegrationTest;

class LabelTest extends IntegrationTest
{
    public function test_default_label_tag()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test'])->render();

        $this->assertRegExp('/<label[\S\s]*>[\S\s]*<\/label>/', $output);
    }

    public function test_custom_label_tag()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test', 'labelTag' => 'legend'])->render();

        $this->assertRegExp('/<legend[\S\s]*>[\S\s]*<\/legend>/', $output);
    }

    public function test_label_references_control()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test', 'controlId' => 'a'])->render();

        $this->assertRegExp('/<label[\S\s]*for="a"[\S\s]*>[\S\s]*<\/label>/', $output);
    }

    public function test_generated_label_is_humanized()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test_input'])->render();

        $this->assertRegExp('/<label[\S\s]*>Test input<\/label>/', $output);
    }
}
