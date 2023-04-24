<?php

namespace Kontenta\Kontour\Tests\Feature\FormViewTests;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Facades\View;
use Kontenta\Kontour\Tests\IntegrationTest;

class TimeTest extends IntegrationTest
{
    public function test_displays_relative_time_by_default()
    {
        $carbon = Carbon::now();
        $output = View::make('kontour::elements.time', compact('carbon'))->render();

        $this->assertStringContainsString('datetime="' . $carbon->toAtomString() . '"', $output);
        $this->assertMatchesRegularExpression('/>\d seconds? ago<\/time>$/', $output);
    }

    public function test_can_format_time()
    {
        $carbon = Carbon::now();
        $format = 'Y';
        $output = View::make('kontour::elements.time', compact('carbon', 'format'))->render();

        $this->assertStringContainsString('datetime="' . $carbon->toAtomString() . '"', $output);
        $this->assertStringContainsString('>' . $carbon->format($format) . '</time>', $output);
    }

    public function test_can_use_default_format_from_config()
    {
        $carbon = Carbon::now();
        $format = true;
        $output = View::make('kontour::elements.time', compact('carbon', 'format'))->render();

        $this->assertStringContainsString('datetime="' . $carbon->toAtomString() . '"', $output);
        $this->assertStringContainsString('>' . $carbon->format(config('kontour.time_format')) . '</time>', $output);
    }

    public function test_can_display_time_interval()
    {
        $carbon = CarbonInterval::year();
        $output = View::make('kontour::elements.time', compact('carbon'))->render();

        $this->assertStringContainsString('datetime="' . $carbon->spec() . '"', $output);
        $this->assertStringContainsString('>' . $carbon->forHumans() . '</time>', $output);
    }
}
