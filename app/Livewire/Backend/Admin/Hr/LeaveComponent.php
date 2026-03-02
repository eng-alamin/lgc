<?php

namespace App\Livewire\Backend\Admin\Hr;

use Livewire\Component;
use App\Models\Leave;
use App\Models\Employee;
use App\Models\LeaveType;

class LeaveComponent extends Component
{
    public $leave_id;
    public $delete_id;

    public $employee_id;
    public $leave_type_id;
    public $start_date;
    public $end_date;
    public $reason;

    protected $listeners = [
        'deleteConfirmed' => 'deletedLeave',
    ];

    public function render()
    {
        $this->dispatch('refreshSelect');

        $data = Leave::latest()->get();
        $employees = Employee::get();
        $leaveTypes = LeaveType::where('status', true)->get();

        return view('livewire.backend.admin.hr.leave-component', [
            'data' => $data,
            'employees' => $employees,
            'leaveTypes' => $leaveTypes,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Leaves | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->leave_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->description = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'employee_id' => 'required',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);
    }

    public function store()
    {
        $this->validate([
            'employee_id' => 'required',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        try{
            $total_days = \Carbon\Carbon::parse($this->start_date)->diffInDays(\Carbon\Carbon::parse($this->end_date)) + 1;

            $data = Leave::create([
                'employee_id' => $this->employee_id,
                'leave_type_id' => $this->leave_type_id,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'total_days' => $total_days,
                'reason' => $this->reason,
                'status' => 'pending'
            ]);

            // Log the activity
            activity()
            ->useLog('leave')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leave is created for information.");


            return redirect('admin/hr/leaves')->with('success', 'Leave is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Leave updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Leave::findOrFail($id);
        $this->leave_id = $edit->id;
        $this->employee_id = $edit->employee_id;
        $this->leave_type_id = $edit->leave_type_id;
        $this->start_date = $edit->start_date;
        $this->end_date = $edit->end_date;
        $this->total_days = $edit->total_days;
        $this->reason = $edit->reason;
        $this->status = $edit->status;

        $this->dispatch('refreshSelect');

    }
    public function update()
    {
        $this->validate([
            'employee_id' => 'required',
            'leave_type_id' => 'required|exists:leave_types,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'nullable|string|max:500',
        ]);

        try{
            $data = Leave::find($this->leave_id);
            $data->employee_id = $this->employee_id;
            $data->leave_type_id = $this->leave_type_id;
            $data->start_date = $this->start_date;
            $data->end_date = $this->end_date;
            $data->total_days = $this->total_days;
            $data->reason = $this->reason;
            $data->save();

            // Log the activity
            activity()
            ->useLog('Leave')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The Leave is updated for information.");

            return redirect('admin/hr/leaves')->with('success', 'Leave is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Leave updated failed: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id, $status)
    {
        $data = Leave::findOrFail($id);
        $data->update([
            'status' => $status,
            'approved_by' => auth()->id()
        ]);
        return redirect('admin/hr/leaves')->with('success', 'Leave is successfully status');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deletedLeave()
    {
        try{
            $data = Leave::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('Leave')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leave is deleted for information.");

            return redirect('admin/hr/leaves')->with('success', 'Leave is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Leave deleted failed: ' . $e->getMessage());
        }
    }
}