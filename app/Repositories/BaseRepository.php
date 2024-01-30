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

    public function find(int $id): Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return $this->query()->find($id);
    }

    public function update(int $id, array $data): Model|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        /**
         * @var Model $model
         */
        $model = $this->find($id);
        $model->update($data);

        return $model;
    }

    public function delete(int $id): ?bool
    {
        /**
         * @var Model $model
         */
        $model = $this->find($id);

        return $model->delete();
    }
}
