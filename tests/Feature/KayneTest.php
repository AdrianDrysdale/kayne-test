<?php

namespace Tests\Feature;

use App\Models\ApiToken;
use App\Models\Quote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Tests\TestCase;

class KayneTest extends TestCase
{
    use RefreshDatabase;

    protected string $token;

    protected function setUp(): void
    {
        parent::setUp();
        Http::fake([
            'https://api.kanye.rest' => Http::sequence()
                ->push(['quote' => 'quote 1'])
                ->push(['quote' => 'quote 2'])
                ->push(['quote' => 'quote 3'])
                ->push(['quote' => 'quote 4'])
                ->push(['quote' => 'quote 5'])
                ->push(['quote' => 'quote 6'])
        ]);

        $this->token = Str::random(60);
        ApiToken::create(['api_token' => hash('sha256', $this->token)]);
    }

    public function testFiveRandomQuotesReturned(): void
    {
        $response = $this->get('/api/kayne?api_token=' . $this->token);
        $response->assertStatus(200);
        $this->assertCount(5, json_decode($response->getContent()));
    }

    public function testQuotesAreCached(): void
    {
        Quote::create(['quote' => 'Cache Quote']);
        $response = $this->get('/api/kayne?api_token=' . $this->token);
        $this->assertEquals(['Cache Quote'], json_decode($response->getContent()));
    }

    public function testQuotesAreRefreshed(): void
    {
        Quote::create(['quote' => 'Cache Quote']);
        $response = $this->get('/api/kayne/fresh?api_token=' . $this->token);
        $response->assertStatus(200);
        $this->assertCount(5, json_decode($response->getContent()));
    }
}
