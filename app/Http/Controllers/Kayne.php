<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Kayne extends Controller
{
    public function index()
    {
        if (Cache::has('quotes')) {
            return Cache::get('quotes');
        }

        $quotes = [];

        try {
            for ($i = 1; $i <= 5; $i++) {
                $quotes[] = Http::get(env('KAYNE_API'))->json()['quote'];
            }
        } catch(ConnectionException $ex) {
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
