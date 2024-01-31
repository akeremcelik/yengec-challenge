<?php

namespace App\Console\Commands\Integration;

use Illuminate\Console\Command;

class DeleteIntegrationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-integration-command {integration}';

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
        $integrationService = app('IntegrationService');
        $integrationCommonService = app('IntegrationCommonService');

        $integration = $integrationService->findIntegrationById($this->argument('integration'));
        $integrationCommonService->deleteCommonIntegration($integration);
    }
}
