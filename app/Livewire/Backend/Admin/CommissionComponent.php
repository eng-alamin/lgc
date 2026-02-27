<?php

namespace App\Livewire\Backend\Admin;

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
        $data = Commission::when($this->statusFilter,
            fn($q) => $q->where('status', $this->statusFilter)
        )->latest()->get();

        return view('livewire.backend.admin.commission-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Commission Rulse | Let's Go China",
        ]);
    }

    public function approve($id)
    {
        $commission = Commission::find($id);
        $commission->update([
            'status' => 'approved',
            'approved_by' => auth()->id()
        ]);
        return redirect()->route('admin.commissions')->with('success', 'Commission is successfully status!');
    }

    public function markPaid($id)
    {
        Commission::find($id)->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);
        return redirect()->route('admin.commissions')->with('success', 'Commission is successfully mark!');
    }

}