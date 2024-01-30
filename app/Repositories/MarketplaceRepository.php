<?php

namespace App\Repositories;

use App\Models\Marketplace;
use App\Repositories\Contracts\MarketplaceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class MarketplaceRepository extends BaseRepository implements MarketplaceRepositoryInterface
{
    public function __construct(Marketplace $model)
    {
        parent::__construct($model);
    }

    public function findMarketplaceByName(string $name): Model|\Illuminate\Database\Eloquent\Builder|null
    {
        return $this->query()
            ->where('name', $name)
            ->first();
    }
}
