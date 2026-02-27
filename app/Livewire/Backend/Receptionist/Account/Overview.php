<?php

namespace App\Livewire\Backend\Receptionist\Account;

use Livewire\Component;
use App\Models\User;

class Overview extends Component
{
    public function render()
    {
        $data = User::findOrFail(auth()->id());

        return view('livewire.backend.receptionist.account.overview', [
            'data' => $data,
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Overview | Let's Go China",
        ]);
    }
}
