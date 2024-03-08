<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class UserService
{
    public static function index()
    {
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
    public static function registerUser(Request $request)
    {
        $userInfo = $request->validated();
        switch (Route::currentRouteName()) {
            case 'user.register':
                $userInfo['role'] = 'user';
                break;
            case 'manager.register':
                $userInfo['role'] = 'manager';
                break;
            case 'itdesk.register':
                $userInfo['role'] = 'itdesk';
                break;
            default:
                break;
        }
        $user = User::create($userInfo);
        try {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public static function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['message' => 'Login Successful', 'token' => $token], 200);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public static function logout($request)
    {
        try {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' =>'Logout successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
