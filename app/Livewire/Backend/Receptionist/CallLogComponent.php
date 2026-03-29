<?php

namespace App\Livewire\Backend\Receptionist;

use Livewire\Component;
use App\Models\CallLog;
use App\Models\User;

class CallLogComponent extends Component
{
    public $type = 'call';
    public $name,$phone,$service,$remarks,$follow_up_date,$assigned_to;
    public $status = 'new';

    public $logs;

    protected $rules = [
        'type'=>'required',
        'name'=>'required',
        'phone'=>'nullable',
        'service'=>'nullable',
        'follow_up_date'=>'nullable|date',
        'assigned_to'=>'nullable',
        'remarks'=>'nullable'
    ];

     public function mount()
    {
        $this->loadLogs();
    }

    public function loadLogs()
    {
        $this->logs = CallLog::latest()->get();
        $this->dispatch('refreshSelect', ['type' => $this->type]);
    }

    public function store()
    {
        $this->validate();

        CallLog::create([
            'type'=>$this->type,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'service'=>$this->service,
            'remarks'=>$this->remarks,
            'follow_up_date'=>$this->follow_up_date,
            'assigned_to'=>$this->assigned_to,
            'status'=>$this->status,
        ]);

        return redirect()->route('receptionist.calllogs')->with('success', 'Data Created Successfully.');

        // $this->reset(['name','phone','service','remarks','follow_up_date','assigned_to']);
        // $this->loadLogs();
        // session()->flash('success','Entry Saved Successfully!');
    }

    public function updateStatus($id,$status)
    {
        $log = CallLog::find($id);
        if(!$log) return;

        $log->update(['status'=>$status]);
         return redirect()->route('receptionist.calllogs')->with('success', 'Data Updated Successfully.');
        // $this->loadLogs();
    }

    public function render()
    {
        return view('livewire.backend.receptionist.call-log-component', [
             'staffs'=>User::where('type','agent')->get()
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Call Logs | Let's Go China",
        ]);
    }
}
