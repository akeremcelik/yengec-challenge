<?php

namespace App\Console\Commands\Integration;

use Illuminate\Console\Command;

class CreateIntegrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-integration-command {marketplace} {username} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [
            'marketplace' => $this->argument('marketplace'),
            'username' => $this->argument('username'),
            'password' => $this->argument('password'),
        ];

        $integrationCommonService = app('IntegrationCommonService');
        $integrationCommonService->createIntegration($data);
    }
}
