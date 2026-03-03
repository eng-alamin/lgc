<?php

namespace App\Livewire\Backend\Writer\Account;

use Livewire\Component;
use App\Models\User;

class Overview extends Component
{
    public function render()
    {
        $data = User::findOrFail(auth()->id());

        return view('livewire.backend.writer.account.overview', [
            'data' => $data,
        ])
        ->layout('layouts.writer.app', [
            'title' => "Overview | Let's Go China",
        ]);
    }
}
