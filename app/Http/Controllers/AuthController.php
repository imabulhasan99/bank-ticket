<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return UserService::registerUser($request);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        return UserService::login($credentials);
    }
}
