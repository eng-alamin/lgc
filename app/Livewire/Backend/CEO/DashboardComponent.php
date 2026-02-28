<?php

namespace App\Livewire\Backend\CEO;

use Livewire\Component;
use App\Models\User;

class DashboardComponent extends Component
{
    public function render()
    {
        $users = User::where('type', 'user')->latest()->get();

        return view('livewire.backend.ceo.dashboard-component', [
            'users' => $users,
        ])
        ->layout('layouts.ceo.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }
}
