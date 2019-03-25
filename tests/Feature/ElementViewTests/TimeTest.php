<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Tests\IntegrationTest;

class TimeTest extends IntegrationTest
{
    public function test_displays_relative_time_by_default()
    {
        $carbon = Carbon::now();
        $output = View::make('kontour::elements.time', compact('carbon'))->render();

        $this->assertContains('datetime="' . $carbon->toAtomString() . '"', $output);
        $this->assertRegExp('/>\d seconds? ago<\/time>$/', $output);
    }

    public function test_can_format_time()
    {
        $carbon = Carbon::now();
        $format = 'Y';
        $output = View::make('kontour::elements.time', compact('carbon', 'format'))->render();

        $this->assertContains('datetime="' . $carbon->toAtomString() . '"', $output);
        $this->assertContains('>' . $carbon->format($format) . '</time>', $output);
    }
}
