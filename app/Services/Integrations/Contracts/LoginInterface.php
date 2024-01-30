<?php

namespace App\Services\Integrations\Contracts;

interface LoginInterface
{
    public function login(string $username, string $password);
}
