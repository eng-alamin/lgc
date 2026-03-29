<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        // First check by provider_id
        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        // If not found, check by email (important)
        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Link existing account
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name' => $socialUser->getName() ?? 'User',
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(uniqid()),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'account_status' => 1, // optional
                ]);

                Client::create([
                    'user_id' => $user->id,
                ]);
            }
        }

        Auth::login($user);

        return redirect()->route('personalinfo');
    }
}
