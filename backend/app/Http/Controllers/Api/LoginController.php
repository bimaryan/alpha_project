<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role_id == Role::ADMIN) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Admin logged in successfully',
                    'user' => $user,
                    'token' => $token
                ], 200);
            } elseif ($user->role_id == Role::PESERTA) {
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Participant logged in successfully',
                    'user' => $user,
                    'token' => $token
                ], 200);
            }
        }

        return response()->json([
            'error' => 'Invalid email or password'
        ], 401);
    }
}
