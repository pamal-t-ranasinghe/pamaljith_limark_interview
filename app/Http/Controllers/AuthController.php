<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while processing your request.'], 500);
        }

    }
}
