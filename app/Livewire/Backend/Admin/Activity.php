<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;

class Activity extends Component
{
    public function render()
    {
        $data = \DB::table('activity_log')->latest()->get();

        return view('livewire.backend.admin.activity', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Activity Log | Let's Go China",
        ]);
    }
}
