<?php

namespace App\Quote;

use Illuminate\Support\Facades\Facade;

class Quote extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'quote';
    }
}
