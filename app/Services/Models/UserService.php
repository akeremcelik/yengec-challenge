<?php

namespace App\Services\Models;

use App\Models\User;
use App\Repositories\Contracts\BaseRepositoryInterface;

class UserService
{
    public mixed $userRepository;

    public function __construct()
    {
        $this->userRepository = app(BaseRepositoryInterface::class, [
            'model' => app(User::class),
        ]);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }
}
