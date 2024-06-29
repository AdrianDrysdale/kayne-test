<?php

namespace Tests\Feature;

use App\Models\ApiToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class KayneTest extends TestCase
{
    use RefreshDatabase;

    public function testTokenAuthorisationWorks(): void
    {
        $token = Str::random(60);
        ApiToken::create([ 'api_token' => hash('sha256', $token)]);
        $response = $this->get('/api/test?api_token='. $token);
        $response->assertStatus(200);
    }
}
