<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\User;

class Overview extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $data = User::findOrFail($this->user->id);

        return view('livewire.backend.admin.user.overview', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Overview | Let's Go China",
        ]);
    }
}
