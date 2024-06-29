<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class Kayne extends Controller
{
    public function index() {

        $quotes = [];

        for ($i = 1; $i <= 5; $i++) {
            $quotes[] = Http::get('https://api.kanye.rest')->json()['quote'];
        }

        return response()->json($quotes);
    }
}
