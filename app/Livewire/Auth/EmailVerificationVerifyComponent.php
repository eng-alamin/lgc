<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use DB;
use Carbon\Carbon;
use App\Models\User;

class EmailVerificationVerifyComponent extends Component
{
    public function mount($id)
    {
        $user = User::where('remember_token', $id)->first();
        if(!$user) {
                session()->flash('error', 'Invalid token!');
                return redirect()->route('verification.notice');
        }

        User::find(auth()->id())->update(['email_verified_at' => now()]);
        return redirect()->to(auth()->user()->getRedirectRoute());

     }

    public function render()
    {
        return view('livewire.auth.email-verification-verify-component');
    }
}
