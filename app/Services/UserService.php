<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\BaseRepositoryInterface;

class UserService
{
    public mixed $repository;

    public function __construct()
    {
        $this->repository = app(BaseRepositoryInterface::class, [
            'model' => app(User::class),
        ]);
    }

    public function createUser(array $data)
    {
        return $this->repository->create($data);
    }
}
