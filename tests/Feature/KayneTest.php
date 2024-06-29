<?php

namespace Tests\Feature;

use App\Models\ApiToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class KayneTest extends TestCase
{
    use RefreshDatabase;

    public function testTokenAuthorisationWorks(): void
    {
        Http::fake([
            'https://api.kanye.rest' => Http::sequence()
                ->push(['quote' => 'quote 1'])
                ->push(['quote' => 'quote 2'])
                ->push(['quote' => 'quote 3'])
                ->push(['quote' => 'quote 4'])
                ->push(['quote' => 'quote 5'])
                ->push(['quote' => 'quote 6'])
        ]);

        $token = Str::random(60);
        ApiToken::create([ 'api_token' => hash('sha256', $token)]);
        $response = $this->get('/api/kayne?api_token='. $token);

        $response->assertStatus(200);
        $this->assertEquals(5, count(json_decode($response->getContent())));

    }
}
