<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\RegisterRequest;

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
