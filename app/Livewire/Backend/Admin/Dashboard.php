<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.dashboard')
        ->layout('layouts.backend.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }
}
