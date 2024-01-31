<?php

namespace App\Console\Commands\Integration;

use Illuminate\Console\Command;

class UpdateIntegrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-integration-command {integration} {--username=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $data = [];

        if ($this->option('username'))
            $data['username'] = $this->option('username');

        if ($this->option('password'))
            $data['password'] = $this->option('password');

        $integrationService = app('IntegrationService');
        $integrationCommonService = app('IntegrationCommonService');

        $integration = $integrationService->findIntegrationById($this->argument('integration'));
        $integrationCommonService->updateCommonIntegration($integration, $data);
    }
}
