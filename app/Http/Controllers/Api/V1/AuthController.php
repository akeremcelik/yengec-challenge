<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\WrongCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Resources\Api\V1\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();

        $userService = app('UserService');
        $user = $userService->createUser($data);

        return UserResource::make($user);
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();

            $email = $data['email'];
            $password = $data['password'];

            $loginService = app('LoginService');
            $token = $loginService->login($email, $password);

            return response()->json([
                'token' => $token,
            ]);
        } catch (WrongCredentialsException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }
}
