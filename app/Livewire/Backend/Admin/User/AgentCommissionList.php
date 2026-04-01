<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Commission;

class AgentCommissionList extends Component
{
    public $user;

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $data = Commission::where('agent_id', $this->user->agent->id)->latest()->get();

        return view('livewire.backend.admin.user.agent-commission-list', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Commission | Let's Go China",
        ]);
    }

    public function approve($id)
    {
        $commission = Commission::find($id);
        $commission->update([
            'status' => 'approved',
            'approved_by' => auth()->id()
        ]);
        return redirect()->route('admin.user.agent.commission', $id)->with('success', 'Commission is successfully status!');
    }

    public function markPaid($id)
    {
        Commission::find($id)->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);
        return redirect()->route('admin.user.agent.commission', $id)->with('success', 'Commission is successfully mark!');
    }

}
