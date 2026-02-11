<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SignupComponent extends Component
{
    public $name;
    public $email;
    public $phone;
    public $password;
    public $password_confirmation;
    public $toc = false; // terms & conditions

    public function render()
    {  
        return view('livewire.auth.signup-component')
        ->layout('layouts.auth.app', [
            'title' => "Sign Up | Let's Go China",
        ]);
    }

    public function updated($property)
    {
        $rules = [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:8',
        ];

        if ($property === 'password_confirmation') {
            $rules['password_confirmation'] = 'required|same:password';
        }

        $this->validateOnly($property, $rules);
    }


    public function store()
    {
        $this->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'phone'    => 'required|string|max:20',
            'password' => 'required|min:8|confirmed',
            'toc'      => 'accepted',
        ]);

        try{
            $user = User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'phone'    => $this->phone,
                'password' => Hash::make($this->password),
                'toc'      => $this->toc,
                'account_status' => 0, // pending
            ]);

            // Important: Event triggers email verification
            event(new Registered($user));

            // Log the user in
            Auth::login($user);

            // Redirect to verification notice
            return redirect()->route('verification.notice');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Registration failed. Please try again.: ' . $e->getMessage());
        }
    }
}
