<?php

namespace App\Livewire\Backend\Employee;

use Livewire\Component;
use App\Models\Attendance;

class AttendanceComponent extends Component
{
    public $date;
    public $check_in;
    public $check_out;
    public $status = 'present';

    public function render()
    {
        $this->dispatch('refreshSelect');

        $attendances = Attendance::with('employee.user')
            ->where('employee_id', auth()->user()->employee->id)
            ->latest()
            ->get();

        return view('livewire.backend.employee.attendance-component', [
            'attendances' => $attendances,
        ])
        ->layout('layouts.employee.app', [
            'title' => "Attendances | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->date = '';
        $this->check_in = '';
        $this->status = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'date'=>'required|date'
        ]);
    }

    public function store()
    {
        $this->validate([
            'date'=>'required|date'
        ]);

        Attendance::updateOrCreate(
            [
                'employee_id'=>auth()->user()->employee->id,
                'date'=>$this->date
            ],
            [
                'check_in'=>$this->check_in,
                'check_out'=>$this->check_out,
                'status'=>$this->status
            ]
        );

        return redirect('employee/attendances')->with('success', 'Attendance is successfully Saved');
    }

}