<?php

namespace App\Livewire\Auth;

use Livewire\Component;
// use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginComponent extends Component
{
    public $email;
    public $password;
    public $remember;

    public function render()
    {
        return view('livewire.auth.login-component')->layout('layouts.auth.app');
    }

    public function login()
    {
        $validation = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {

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
