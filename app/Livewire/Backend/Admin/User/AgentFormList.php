<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Form;
use App\Models\Commission;
use App\Models\CommissionRule;

class AgentFormList extends Component
{
    public $user;

    public $form_id;
    public $delete_id;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $data = Form::where('agent_id', $this->user->agent->id)->latest()->get();

        return view('livewire.backend.admin.user.agent-form-list', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Form List | Let's Go China",
        ]);
    }

    public function canChangeTo($currentStatus, $newStatus)
    {
        $flow = config('status_flow.form');

        if (!isset($flow[$currentStatus])) {
            return false;
        }

        return in_array($newStatus, $flow[$currentStatus]);
    }

    public function statusClick($id, $newStatus)
    {
        $form = Form::findOrFail($id);

        // Prevent invalid transition
        if (!$this->canChangeTo($form->status, $newStatus)) {
            session()->flash('error', 'Invalid status transition!');
            return;
        }

        // Already approved check
        if ($form->status === 'approved') {
            session()->flash('error', 'Already Approved');
            return;
        }

        // Update Status
        $form->update([
            'status' => $newStatus
        ]);
        
        if($newStatus == 'approved'){

            // Prevent duplicate commission
            if (Commission::where('form_id', $form->id)->exists()) {
                return;
            }

            // Find commission rule
            $rule = CommissionRule::where('service_type', $form->type)->where('status', true)->first();

            if (!$rule) {
                session()->flash('error', 'No Commission Rule Found');
                return;
            }

            // Calculate commission
            $commissionAmount = 0;

            if ($rule->commission_type === 'percentage') {
                $commissionAmount = ($rule->service_value * $rule->commission_value) / 100;
            } else {
                $commissionAmount = $rule->commission_value;
            }
 
            // Create commission
            Commission::create([
                'form_id' => $form->id,
                'agent_id' => $form->agent_id,
                'total_amount' => $rule->service_value,
                'commission_rate' => $rule->commission_value,
                'commission_amount' => $commissionAmount,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('admin.user.agent.forms', $this->user->id)->with('success', 'Form is successfully status!');
    }

    private function resetInputFields(){
        $this->delete_id = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    public function delete()
    {
        try{
            $data = Form::find($this->delete_id);
            $data->delete();

            return redirect()->route('admin.user.agent.forms', $this->user->id)->with('success', 'Form is successfully deleted!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Form deleted failed: ' . $e->getMessage());
        }
    }
}
