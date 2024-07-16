<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            Log::info('Entering callback function');
    
            // Correctly retrieve the user after the callback
            $user = Socialite::driver('google')->user(); // Changed this line
    
            Log::info('User retrieved from Google', ['user' => $user]);
    
            $finduser = User::where('google_id', $user->id)->first();
    
            Log::info('User found in database', ['foundUser' => $finduser]);
    
            if ($finduser) {
                Log::info('Existing user found, logging in');
                Auth::login($finduser);
                return redirect()->intended('dashboard');
            } else {
                Log::info('Creating new user');
                $newUser = User::updateOrCreate(
                    ['email' => $user->email],
                    [
                        'name' => $user->name,
                        'google_id' => $user->id,
                        'password' => bcrypt('123456dummy') // Use bcrypt for password hashing
                    ]
                );
    
                Log::info('New user created', ['newUser' => $newUser]);
    
                Auth::login($newUser);
                return redirect()->intended('dashboard');
            }
        } catch (\Exception $e) {
            Log::error('Error occurred during Google authentication', [
                'error' => $e->getMessage(),
                'stackTrace' => $e->getTraceAsString(),
            ]);
    
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }
    
}
