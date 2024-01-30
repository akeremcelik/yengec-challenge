<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\IntegrationLoginRequest;
use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function login(IntegrationLoginRequest $request)
    {
        $data = $request->validated();
    }
}
