<?php

namespace App\Livewire\Backend\Admin\Account;

use Livewire\Component;

class Activity extends Component
{
    public function render()
    {
        $data = \DB::table('activity_log')->where('causer_id', auth()->id())->latest()->get();

        return view('livewire.backend.admin.account.activity', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Activity Log | Let's Go China",
        ]);
    }
}
