<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Branch;
use App\Models\User;
use App\Services\UserService;

class AuthController extends Controller
{
    public function index()
    {
        $this->authorize('view', Branch::class);
        try {
            $user = auth()->user();
            switch ($user->role) {
                case 'manager':
                    $user = User::with(['tickets', 'branch'])->where(function ($query) use ($user) {
                        $query->where('branch_id', $user->branch_id);
                    })->get();

                    return response()->json(['user' => $user]);
                    break;
                case 'itdesk':
                    $user = User::with(['tickets', 'branch'])->get();

                    return response()->json(['user' => $user]);
                    break;
                default:
                    break;
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
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
}
