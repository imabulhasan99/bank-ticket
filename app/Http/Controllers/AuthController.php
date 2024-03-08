<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Services\UserService;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        $this->authorize('view', Branch::class);
        return UserService::index();
    }

    public function register(RegisterRequest $request)
    {
        return UserService::registerUser($request);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        return UserService::login($credentials);
    }

    public function logout(Request $request)
{
    return UserService::logout($request);
}
}
