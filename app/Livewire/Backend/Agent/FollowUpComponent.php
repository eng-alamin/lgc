<?php

namespace App\Livewire\Backend\Agent;

use Livewire\Component;
use App\Models\FollowUp;
use App\Models\Form;
use App\Models\User;
use Carbon\Carbon;

class FollowUpComponent extends Component
{
    public $form_id, $follow_up_date, $priority='normal', $notes, $status='pending';

    public $followup_id;
    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteFollowup',
    ];
    
    public $agent_id;
    
    public function mount()
    {
        $this->agent_id = auth()->user()->agent->id;
    }

    public function render()
    {
        $this->dispatch('refreshSelect');
        
        return view('livewire.backend.agent.follow-up-component',[
            // 'followUps'=>FollowUp::where('form_id', auth()->user()->agent->form->id)->latest()->get(),
            // 'todayTasks'=>FollowUp::where('form_id', auth()->user()->agent->form->id)->today()->latest()->get(),
            // 'overdueTasks'=>FollowUp::where('form_id', auth()->user()->agent->form->id)->overdue()->latest()->get(),
            'followUps'=>FollowUp::where('assign_id', $this->agent_id)->latest()->get(),
            'todayTasks'=>FollowUp::where('assign_id', $this->agent_id)->today()->latest()->get(),
            'overdueTasks'=>FollowUp::where('assign_id', $this->agent_id)->overdue()->latest()->get(),
            'forms'=>Form::where('agent_id', $this->agent_id)->latest()->get(),
        ])
        ->layout('layouts.agent.app', [
            'title' => "Follow Up | Let's Go China",
        ]);
    }

    public function markDone($id)
    {
        $follow = FollowUp::find($id);
        if($follow){
            $follow->status = 'done';
            $follow->save();
           return redirect()->route('agent.followups')->with('success', 'Consignee is successfully marked');
        }
    }

        private function resetInputFields()
    {
        $this->form_id = '';
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
            'follow_up_date'=>'required|date',
            'priority'=>'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'form_id'=>'required|exists:forms,id',
            'follow_up_date'=>'required|date',
            'priority'=>'required',
        ]);

        FollowUp::create([
            'form_id'=>$this->form_id,
            'assign_id'=>$this->agent_id,
            'follow_up_date'=>$this->follow_up_date,
            'priority'=>$this->priority,
            'status'=>$this->status,
            'notes'=>$this->notes,
        ]);

        return redirect()->route('agent.followups')->with('success', 'Data Created Successfully.');
    }

    public function edit($id)
    {
        $edit = FollowUp::findOrFail($id);
        $this->invoice_id = $id;
        $this->form_id = $edit->form_id;
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

            return redirect()->route('agent.followups')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }
}
