<?php

namespace Tests\Unit;

use App\Quote\Kayne;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class KayneTest extends TestCase
{

    public function testQuotesReturned(): void
    {
        Http::fake([
            env('KAYNE_API') => Http::sequence()
                ->push(['quote' => 'quote 1'])
                ->push(['quote' => 'quote 2'])
                ->push(['quote' => 'quote 3'])
                ->push(['quote' => 'quote 4'])
                ->push(['quote' => 'quote 5'])
                ->push(['quote' => 'quote 6'])
        ]);

        $kayne = new Kayne();
        $this->assertCount(5 ,$kayne->quotes());
    }
}
