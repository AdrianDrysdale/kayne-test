<?php

namespace App\Quote;

use Illuminate\Support\Facades\Http;

class Kayne implements QuoteInterface
{
    public function quotes(): array
    {
        $quotes = [];

        for ($i = 1; $i <= 5; $i++) {
            $quotes[] = Http::get(env('KAYNE_API'))->throw()->json()['quote'];
        }

        return $quotes;
    }
}
