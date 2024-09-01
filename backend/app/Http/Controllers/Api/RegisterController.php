<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
$register = new User();
        $register->name = $request->input('name');
        $register->email = $request->input('email');
        $register->password = Hash::make($request->input('password'));
        $register->role_id = Role::PESERTA;
        $register->save();


        return response()->json([
            'message' => 'User registered successfully',
            'user' => $register
        ], 201);
    }
}
