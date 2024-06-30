<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Kayne extends Controller
{
    public function index()
    {
        if (Cache::has('quotes')) {
            return Cache::get('quotes');
        }

        for ($i = 1; $i <= 5; $i++) {
            $quotes[] = Http::get(env('KAYNE_API'))->json()['quote'];
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
