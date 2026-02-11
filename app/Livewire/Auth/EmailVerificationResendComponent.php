<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Mail;
use Str;
use App\Mail\SendVerificationMail;

class EmailVerificationResendComponent extends Component
{
    public function mount()
    {
        $user = User::find(auth()->id());
        $token = Str::random(64);
        $user->update([
            'remember_token' => $token
          ]);

        $maildata = [
            'title' => 'Email Verification Mail',
            'content' => 'You can email verification mail from bellow link:',
            'token' => $token
        ];

        Mail::to($user->email)->send(new SendVerificationMail($maildata));

        session()->flash('success', 'We have e-mailed your password reset link!');
        return redirect()->route('verification.notice');
    }

    public function render()
    {
        return view('livewire.auth.email-verification-resend-component');
    }
}
