<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->stateless()->redirect();
        // try {
            
        //     //code...
        // } catch (ClientException $exception) {
        //     return response()->json(['error' => "Invaild credentials"]);
        // };
    }

    public function handleGoogleCallback() {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            //code...
        } catch (ClientException $exception) {
            return response()->json(['error' => "Invaild credentials"]);
        };

        $findOrCreateUser = User::firstOrCreate(
            [
                'email' => $user->getEmail(),
            ],
            [
                'name' => $user->getName(),
                'email_verified_at' => now(),
            ]
        );
        $findOrCreateUser->provider()->updateOrCreate([
            'provider' => 'google',
            'provider_id' => $user->getId(),
        ]);

        $token = $findOrCreateUser->createToken('api-token')->plainTextToken;

        // return response()->json($findOrCreateUser, 200, ['token' => $token]);
        return response()->json(['token' => $token]);
    }
}