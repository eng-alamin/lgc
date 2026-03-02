<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceComponent extends Component
{
    public $today;
    public $checkInTime;
    public $checkOutTime;

    public function mount()
    {
        $this->today = Carbon::today()->toDateString();

        $attendance = Attendance::where('employee_id', Auth::user()->employee->id)
            ->whereDate('date', $this->today)
            ->first();

        if($attendance){
            $this->checkInTime = $attendance->check_in;
            $this->checkOutTime = $attendance->check_out;
        }
    }

    public function checkIn()
    {
        $employee_id = Auth::user()->employee->id;

        $attendance = Attendance::firstOrCreate(
            ['employee_id'=>$employee_id,'date'=>$this->today],
            ['check_in'=>now(),'status'=>'present']
        );

        $this->checkInTime = $attendance->check_in;
        session()->flash('success','Checked In Successfully');
    }

    public function checkOut()
    {
        $employee_id = Auth::user()->employee->id;

        $attendance = Attendance::where('employee_id',$employee_id)
            ->whereDate('date',$this->today)
            ->first();

        if(!$attendance){
            session()->flash('error','Please Check In First');
            return;
        }

        $attendance->update([
            'check_out'=>now(),
            'total_hours'=>round((strtotime(now()) - strtotime($attendance->check_in))/3600,2)
        ]);

        $this->checkOutTime = $attendance->check_out;
        session()->flash('success','Checked Out Successfully');
    }

    public function render()
    {
        $employee_id = Auth::user()->employee->id;
        $attendances = Attendance::where('employee_id',$employee_id)
            ->latest()
            ->paginate(10);

        return view('ivewire.backend.attendance-component', compact('attendances'));
    }
}