<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateTokenTest extends TestCase
{
    use RefreshDatabase;

    public function testGenerateTokenCommand(): void
    {
        $this->artisan('make:apiToken')
            ->expectsOutputToContain('Token')
            ->assertExitCode(0);
    }
}
