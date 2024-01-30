<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    public Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model->query();
    }

    public function create(array $data): Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->query()->create($data);
    }
}
