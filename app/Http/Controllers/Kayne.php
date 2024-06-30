<?php

namespace App\Http\Controllers;

use App\Quote\Quote;
use Illuminate\Support\Facades\Cache;

class Kayne extends Controller
{
    public function index()
    {
        if (Cache::has('quotes')) {
            return Cache::get('quotes');
        }

        try {
            $quotes = Quote::driver('kayne')->quotes();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve quotes'], 503);
        }

        Cache::put('quotes', $quotes, 180);
        return response()->json($quotes);
    }

    public function fresh()
    {
        Cache::flush();
        return $this->index();
    }
}
