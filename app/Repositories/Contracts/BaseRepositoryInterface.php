<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function query();
    public function create(array $data);
    public function find(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
}
