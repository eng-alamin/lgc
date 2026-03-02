<?php

namespace App\Livewire\Backend\Admin\Hr;

use Livewire\Component;
use App\Models\LeaveType;

class LeaveTypeComponent extends Component
{
    public $leavetype_id;
    public $delete_id;

    public $name;
    public $days_allowed;
    public $status = true;

    protected $listeners = [
        'deleteConfirmed' => 'deletedLeaveType',
    ];

    public function render()
    {
        $data = LeaveType::get();

        return view('livewire.backend.admin.hr.leave-type-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "leave types | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->leavetype_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->days_allowed = '';
        $this->status = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'name' => 'required|string|max:255',
            'days_allowed' => 'required|integer|min:0'
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'days_allowed' => 'required|integer|min:0'
        ]);

        try{
            $data = new LeaveType();
            $data->name = $this->name;
            $data->days_allowed  = $this->days_allowed ;
            $data->status = $this->status;
            $data->save();

            // Log the activity
            activity()
            ->useLog('leavetype')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leavetype is created for information.");


            return redirect('admin/hr/leavetypes')->with('success', 'LeaveType is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'LeaveType updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = LeaveType::findOrFail($id);
        $this->leavetype_id = $edit->id;
        $this->name = $edit->name;
        $this->days_allowed = $edit->days_allowed;
        $this->status = $edit->status;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'days_allowed' => 'required|integer|min:0'
        ]);

        try{
            $data = LeaveType::find($this->leavetype_id);
            $data->name = $this->name;
            $data->days_allowed = $this->days_allowed;
            $data->status = $this->status;
            $data->save();

            // Log the activity
            activity()
            ->useLog('leavetype')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leave type is updated for information.");

            return redirect('admin/hr/leavetypes')->with('success', 'Leave Type is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Leave Type updated failed: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $leavetype = LeaveType::findOrFail($id);
        $leavetype->update([
            'status' => !$leavetype->status
        ]);
        return redirect('admin/hr/leavetypes')->with('success', 'Leave Type is successfully status');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deletedLeaveType()
    {
        try{
            $data = LeaveType::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('leavetype')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leave type is deleted for information.");

            return redirect('admin/hr/leavetypes')->with('success', 'Leave Type is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Leave Type deleted failed: ' . $e->getMessage());
        }
    }
}