<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailComponent extends Component
{
    public function mount(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        // return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }

    public function render()
    {
        return view('livewire.auth.verify-email-component')->layout('layouts.auth.app');
    }
}
