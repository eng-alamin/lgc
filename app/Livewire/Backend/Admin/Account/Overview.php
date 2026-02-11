<?php

namespace App\Livewire\Backend\Admin\Account;

use Livewire\Component;
use App\Models\User;

class Overview extends Component
{
    public function render()
    {
        $data = User::findOrFail(auth()->id());

        return view('livewire.backend.admin.account.overview', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Overview | Let's Go China",
        ]);
    }
}
