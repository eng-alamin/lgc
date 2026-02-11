<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Providers\RouteServiceProvider;

class EmailVerificationPromptComponent extends Component
{
    public function mount(){
        return auth()->user()->hasVerifiedEmail()
        ? redirect()->intended(RouteServiceProvider::HOME)
        : view('livewire.auth.email-verification-prompt-component')->layout('layouts.auth.app');
    }
    public function render()
    {
        return auth()->user()->hasVerifiedEmail()
        ? redirect()->intended(RouteServiceProvider::HOME)
        : view('livewire.auth.email-verification-prompt-component')->layout('layouts.auth.app');
    }
}
