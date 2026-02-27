<?php

namespace App\Livewire\Backend\Receptionist;

use Livewire\Component;
use App\Models\FollowUp;
use App\Models\Form;
use App\Models\User;
use Carbon\Carbon;

class FollowUpComponent extends Component
{
    public $form_id, $assigned_to, $follow_up_date, $priority='normal', $notes, $status='pending';

    public $followup_id;
    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteFollowup',
    ];
    
    public function render()
    {
        $this->dispatch('refreshSelect');
        
        return view('livewire.backend.receptionist.follow-up-component',[
            'followUps'=>FollowUp::latest()->get(),
            'todayTasks'=>FollowUp::today()->latest()->get(),
            'overdueTasks'=>FollowUp::overdue()->latest()->get(),
            'forms'=>Form::latest()->get(),
            'agents'=>User::where('type', 'agent')->get(),
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Follow Up | Let's Go China",
        ]);
    }

    public function markDone($id)
    {
        $follow = FollowUp::find($id);
        if($follow){
            $follow->status = 'done';
            $follow->save();
           return redirect()->route('receptionist.followups')->with('success', 'Consignee is successfully marked');
        }
    }

        private function resetInputFields()
    {
        $this->form_id = '';
        $this->assigned_to = '';
        $this->follow_up_date = '';
        $this->priority = 'normal';
        $this->status = 'pending';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'form_id'=>'required|exists:forms,id',
            'assigned_to'=>'required|exists:users,id',
            'follow_up_date'=>'required|date',
            'priority'=>'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'form_id'=>'required|exists:forms,id',
            'assigned_to'=>'required|exists:users,id',
            'follow_up_date'=>'required|date',
            'priority'=>'required',
        ]);

        FollowUp::create([
            'form_id'=>$this->form_id,
            'assigned_to'=>$this->assigned_to,
            'follow_up_date'=>$this->follow_up_date,
            'priority'=>$this->priority,
            'status'=>$this->status,
            'notes'=>$this->notes,
        ]);

        return redirect()->route('receptionist.followups')->with('success', 'Data Created Successfully.');
    }

    public function edit($id)
    {
        $edit = FollowUp::findOrFail($id);
        $this->invoice_id = $id;
        $this->form_id = $edit->form_id;
        $this->assigned_to = $edit->assigned_to;
        $this->follow_up_date = $edit->follow_up_date;
        $this->priority = $edit->priority;
        $this->status = $edit->status;
        $this->notes = $this->notes;
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteFollowup()
    {
        try{
            $data = FollowUp::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('followup')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The followup is deleted for information.");

            return redirect()->route('receptionist.followups')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }
}
