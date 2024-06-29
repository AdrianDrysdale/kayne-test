<?php

use App\Http\Controllers\Kayne;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/kayne', [Kayne::class, 'index']);
