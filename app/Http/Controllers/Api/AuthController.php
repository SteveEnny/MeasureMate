<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request) {
        // return response()->json(['message' => 'Login successfully'], 200);
        $request->validate([
            'email' => 'required | email',
            'password' => 'required | password',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user) {
            // return response()->json(['message' => 'User not found'], 404);
            throw ValidationException::withMessages([
                'email' => ['The provided crediental are incorrect'],
            ]);
        }

        if(!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credential are incorrect.']
            ]);
        }

        $token = $user->createToken('api-token')->publicTextToken;

        return response()->json([
            "token" => $token,
        ]);
    }
}