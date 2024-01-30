<?php

namespace App\Services;

use App\Exceptions\WrongCredentialsException;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function register(array $data)
    {
        $registrationData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        $userService = app('UserService');
        return $userService->createUser($registrationData);
    }

    /**
     * @throws WrongCredentialsException
     */
    public function login(string $email, string $password)
    {
        $data = [
            'email' => $email,
            'password' => $password,
        ];

        if (!Auth::attempt($data)) {
            throw new WrongCredentialsException();
        }

        return Auth::user()->createToken('Token')->accessToken;
    }
}
