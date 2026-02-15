<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\User;

class Dashboard extends Component
{
    public function render()
    {
        $users = User::where('type', 'user')->latest()->get();

        return view('livewire.backend.admin.dashboard', [
            'users' => $users,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }
}
