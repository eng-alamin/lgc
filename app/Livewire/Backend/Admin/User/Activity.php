<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\User;

class Activity extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $data = \DB::table('activity_log')->where('causer_id', $this->user->id)->latest()->get();

        return view('livewire.backend.admin.user.activity', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Activity Log | Let's Go China",
        ]);
    }
}
