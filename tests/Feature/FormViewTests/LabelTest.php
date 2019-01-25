<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Tests\IntegrationTest;
use Illuminate\Support\HtmlString;

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

    public function test_validation_attribute_is_used_for_label()
    {
        Lang::addLines(['validation.attributes.custom_input' => 'tEsT'], Lang::locale());
        $output = View::make('kontour::forms.label', ['name' => 'custom_input'])->render();

        $this->assertRegExp('/<label[\S\s]*>TEsT<\/label>/', $output);
    }

    public function test_label_can_have_prepended_html()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test', 'labelStart' => new HtmlString('<i>pre</i>')])->render();

        $this->assertRegExp('/<label[\S\s]*><i>pre<\/i>[\S\s]*<\/label>/', $output);
    }

    public function test_label_can_have_appended_html()
    {
        $output = View::make('kontour::forms.label', ['name' => 'test', 'labelEnd' => new HtmlString('<i>post</i>')])->render();

        $this->assertRegExp('/<label[\S\s]*>[\S\s]*<i>post<\/i><\/label>/', $output);
    }
}
