<?php

namespace App\Livewire\Backend\Receptionist\Application;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;
use App\Models\Commission;
use App\Models\CommissionRule;

class ListComponent extends Component
{
    public $application_id;
    public $delete_id;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {
        $data = Form::latest()->get();

        return view('livewire.backend.receptionist.application.list-component', [
            'data' => $data,
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Application List | Let's Go China",
        ]);
    }

    public function canChangeTo($currentStatus, $newStatus)
    {
        $flow = config('status_flow.application');

        if (!isset($flow[$currentStatus])) {
            return false;
        }

        return in_array($newStatus, $flow[$currentStatus]);
    }

    public function statusClick($id, $newStatus)
    {
        $application = Form::findOrFail($id);

        // Prevent invalid transition
        if (!$this->canChangeTo($application->status, $newStatus)) {
            session()->flash('error', 'Invalid status transition!');
            return;
        }

        // Already approved check
        if ($application->status === 'approved') {
            session()->flash('error', 'Already Approved');
            return;
        }

        // Update Status
        $application->update([
            'status' => $newStatus
        ]);
        
        if($newStatus == 'approved'){

            // Prevent duplicate commission
            if (Commission::where('form_id', $application->id)->exists()) {
                return;
            }

            // Find commission rule
            $rule = CommissionRule::where('service_type', $application->type)->where('status', true)->first();

            if (!$rule) {
                session()->flash('error', 'No Commission Rule Found');
                return;
            }

            // Calculate commission
            $commissionAmount = 0;

            if ($rule->commission_type === 'percentage') {
                $commissionAmount = ($application->invoiceHasOneForm->total_amount * $rule->commission_value) / 100;
            } else {
                $commissionAmount = $rule->commission_value;
            }

            // Create commission
            Commission::create([
                'form_id' => $application->id,
                'agent_id' => $application->agent_id,
                'total_amount' => $application->invoiceHasOneForm->total_amount,
                'commission_rate' => $rule->commission_value,
                'commission_amount' => $commissionAmount,
                'status' => 'pending',
            ]);
        }

        // Create Status History
        $history = new StatusHistory();
        $history->module = 'form';
        $history->module_id = $application->id;
        $history->status = $newStatus;
        $history->save();

        return redirect()->route('receptionist.application.list')->with('success', 'Application is successfully status!');
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

            return redirect()->route('receptionist.application.list')->with('success', 'Application is successfully deleted!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Application deleted failed: ' . $e->getMessage());
        }
    }
}
