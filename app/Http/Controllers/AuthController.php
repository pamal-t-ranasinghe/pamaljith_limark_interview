<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::firstOrCreate([
            'email' => $request->email
        ]);

        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }
}
