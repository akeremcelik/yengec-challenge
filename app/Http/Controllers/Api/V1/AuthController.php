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
    public mixed $authService;

    public function __construct()
    {
        $this->authService = app('AuthService');
    }

    public function register(RegisterRequest $request): UserResource
    {
        $data = $request->validated();
        $user = $this->authService->register($data);

        return UserResource::make($user);
    }

    public function login(LoginRequest $request)
    {
        try {
            $data = $request->validated();

            $email = $data['email'];
            $password = $data['password'];

            $token = $this->authService->login($email, $password);

            return response()->json([
                'token' => $token,
            ]);
        } catch (WrongCredentialsException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }
}
