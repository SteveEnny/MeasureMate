<?php


namespace App\Actions\Auth;
use App\Http\Traits\ResponseTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoginAction {
    use ResponseTrait;

    public function execute(array $validatedData) {
        if(Auth::attempt($validatedData)) {
            $user = request()->user();
            $token = $user->createToken('Api-Token')->plainTextToken;
            // $refreshCode = Str::random(8);
            // Cache::put($refreshCode, $user);
            return $this->successResponse('Login successful', [
                'token' => $token,
                // 'id' => Auth::id(),
                'token_expires' => Carbon::now()->addMinutes(30),
            ]);
            
        }
        else{
            throw new \ErrorException("Invalid credentials");
        }
    }
}