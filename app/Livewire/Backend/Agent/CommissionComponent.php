<?php

namespace App\Livewire\Backend\Agent;

use Livewire\Component;
use App\Models\Commission;

class CommissionComponent extends Component
{
    public $statusFilter = '';

    protected $listeners = [
        'deleteConfirmed' => 'deleteRule',
    ];

    public function render()
    {
        $data = Commission::where('agent_id', auth()->id())->latest()->get();

        // $data = Commission::when($this->statusFilter,
        //     fn($q) => $q->where('status', $this->statusFilter)
        // )->latest()->get();

        return view('livewire.backend.agent.commission-component', [
            'data' => $data,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Commission Rulse | Let's Go China",
        ]);
    }

}