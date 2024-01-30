<?php

namespace App\Services;

use App\Exceptions\WrongCredentialsException;
use Illuminate\Support\Facades\Auth;

class LoginService
{
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
