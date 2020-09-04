<?php

namespace Kontenta\Kontour\Tests;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\Cache;

abstract class IntegrationTest extends TestCase
{
    use IntegrationTestSetupTrait;

    public function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    /**
     * Split a string of HTML.
     *
     * Note: It doesn't split on complete tags, just when two consecutive tags
     * have no other content between them.
     * So always assert that you're asserting on the intended array item :)
     */
    protected function splitHtmlTags(string $html): array
    {
        // Split between `><` also allowing any number of spaces
        return preg_split('/(?<=>)\s*(?=<)/', $html);
    }
}
