<?php

namespace App\Livewire\Backend\Employee\Account;

use Livewire\Component;
use App\Models\User;

class Overview extends Component
{
    public function render()
    {
        $data = User::findOrFail(auth()->id());

        return view('livewire.backend.employee.account.overview', [
            'data' => $data,
        ])
        ->layout('layouts.employee.app', [
            'title' => "Overview | Let's Go China",
        ]);
    }
}
