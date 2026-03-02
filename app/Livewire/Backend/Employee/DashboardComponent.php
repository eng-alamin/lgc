<?php

namespace App\Livewire\Backend\Employee;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Leave;
use Carbon\Carbon;

class DashboardComponent extends Component
{
    public $totalPresent = 0;
    public $totalAbsent = 0;
    public $totalLeave = 0;
    public $totalOvertime = 0;
    public $thisMonthSalary = 0;
    public $todayStatus = null;


    public function mount()
    {
        $employeeId = auth()->user()->employee->id;

        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd   = Carbon::now()->endOfMonth();

        // Present Days
        $this->totalPresent = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->where('status', 'present')
            ->count();

        // Absent Days
        $this->totalAbsent = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->where('status', 'absent')
            ->count();

        // Leave Days (Approved)
        $this->totalLeave = Leave::where('employee_id', $employeeId)
            ->where('status', 'approved')
            ->whereBetween('start_date', [$monthStart, $monthEnd])
            ->sum('total_days');

        // Overtime Hours
        $this->totalOvertime = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->sum('overtime_hours');

        // This Month Salary
        $thisMonthPayroll = Payroll::where('employee_id', $employeeId)
            ->where('month', Carbon::now()->format('Y-m'))
            ->first();

        $this->thisMonthSalary = $thisMonthPayroll ? $thisMonthPayroll->net_salary : 0;

        // Today Attendance Status
        $todayAttendance = Attendance::where('employee_id', $employeeId)
            ->whereDate('date', Carbon::today())
            ->first();

        $this->todayStatus = $todayAttendance ? ucfirst($todayAttendance->status) : 'Not Marked';
    }

    public function render()
    {
        return view('livewire.backend.employee.dashboard-component')
        ->layout('layouts.employee.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }
}
