<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Support\Facades\Http;

class Kayne extends Controller
{
    public function index()
    {
        $existingQuotes = Quote::all();

        if ($existingQuotes->isNotEmpty()) {
            return $existingQuotes->pluck('quote');
        }

        for ($i = 1; $i <= 5; $i++) {
            $quote = Http::get('https://api.kanye.rest')->json()['quote'];
            Quote::create(['quote' => $quote]);
            $quotes[] = $quote;
        }

        return response()->json($quotes);
    }

    public function fresh()
    {
        Quote::truncate();
        return $this->index();
    }
}
