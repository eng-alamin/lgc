<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class EmailVerificationNoticeComponent extends Component
{

    public function render()
    {
        return view('livewire.auth.email-verification-notice-component')->layout('layouts.auth');
    }
}
