<?php

namespace App\Livewire\Backend\Agent\Account;

use Livewire\Component;
use App\Models\User;

class Overview extends Component
{
    public function render()
    {
        $data = User::findOrFail(auth()->id());

        return view('livewire.backend.agent.account.overview', [
            'data' => $data,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Overview | Let's Go China",
        ]);
    }
}
