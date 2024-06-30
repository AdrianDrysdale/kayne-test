<?php

namespace App\Quote;

use Illuminate\Support\Manager;

class QuoteManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return 'kayne';
    }

    public function createKayneDriver(): Kayne
    {
        return new Kayne();
    }
}
