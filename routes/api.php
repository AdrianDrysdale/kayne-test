<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/test', function (Request $request) {
    return 'Authenticated!';
});
