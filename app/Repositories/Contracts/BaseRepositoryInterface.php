<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function query();
    public function create(array $data);
}
