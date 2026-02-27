<?php

namespace App\Livewire\Backend\Agent\Account;

use Livewire\Component;

class Activity extends Component
{
    public function render()
    {
        $data = \DB::table('activity_log')->where('causer_id', auth()->id())->latest()->get();

        return view('livewire.backend.agent.account.activity', [
            'data' => $data,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Activity Log | Let's Go China",
        ]);
    }
}
