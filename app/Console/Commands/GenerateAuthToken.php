<?php

namespace App\Console\Commands;

use App\Models\ApiToken;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateAuthToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:apiToken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an api token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $token = Str::random(60);
        ApiToken::create([ 'api_token' => hash('sha256', $token)]);
        $this->info($token);
        return 0;
    }
}
