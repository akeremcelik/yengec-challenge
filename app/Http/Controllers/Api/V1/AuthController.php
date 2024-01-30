<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
}
