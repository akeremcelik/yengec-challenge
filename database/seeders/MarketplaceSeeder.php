<?php

namespace Database\Seeders;

use App\Enums\MarketplaceType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marketplaceService = app('MarketplaceService');
        $cases = MarketplaceType::cases();

        foreach ($cases as $case) {
            $marketplaceService->createMarketplace($case->value);
        }
    }
}
