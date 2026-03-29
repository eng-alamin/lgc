<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function render()
    {
        return view('livewire.auth.login-component')->layout('layouts.frontend.app');
    }

    public function store()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials, $this->remember)) {
            session()->regenerate();
            return redirect()->to(auth()->user()->getRedirectRoute());
        } else {
            session()->flash('error', 'Invalid credentials. Please try again.');
        }
    }

    public function logout()
    {
        Auth::logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('login');
    }
}
