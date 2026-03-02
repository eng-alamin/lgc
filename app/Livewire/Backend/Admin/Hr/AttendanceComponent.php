<?php

namespace App\Livewire\Backend\Admin\Hr;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceComponent extends Component
{
    public $employee_id;
    public $date;
    public $check_in;
    public $check_out;
    public $status = 'present';

    public $employees;
    public $attendances;

    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deletedAttendance',
    ];

    public function mount()
    {
        $this->employees = Employee::with('user')->get();
        $this->loadData();
    }

    public function loadData()
    {
        $this->attendances = Attendance::with('employee.user')
            ->latest()
            ->get();
    }

    public function render()
    {
        $this->dispatch('refreshSelect');

        $data = Attendance::get();

        return view('livewire.backend.admin.hr.attendance-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Attendances | Let's Go China",
        ]);
    }

    public function store()
    {
        $this->validate([
            'employee_id'=>'required',
            'date'=>'required|date'
        ]);

        Attendance::updateOrCreate(
            [
                'employee_id'=>$this->employee_id,
                'date'=>$this->date
            ],
            [
                'check_in'=>$this->check_in,
                'check_out'=>$this->check_out,
                'status'=>$this->status
            ]
        );

        return redirect('admin/hr/attendances')->with('success', 'Attendance is successfully Saved');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    public function deletedAttendance()
    {
        try{
            $data = Attendance::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('attendance')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The attendance is deleted for information.");

            return redirect('admin/hr/attendances')->with('success', 'Attendance is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Attendance deleted failed: ' . $e->getMessage());
        }
    }
}