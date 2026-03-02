<?php

namespace App\Livewire\Backend\Admin\Hr;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Attendance;
use App\Models\Payroll;
use App\Models\Payslip;
use App\Models\Leave;
use Carbon\Carbon;
use Storage;
use Pdf;

class PayrollComponent extends Component
{
    public $employee_id;
    public $month;
    public $bonus = 0;

    public $employees;
    public $payrolls;

    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deletedPayroll',
    ];

    public function mount()
    {
        $this->employees = Employee::all();
        $this->loadPayrolls();
    }

    public function render()
    {
        return view('livewire.backend.admin.hr.payroll-component')
        ->layout('layouts.backend.app', [
            'title' => "Payrolls | Let's Go China",
        ]);
    }

    public function loadPayrolls()
    {
        $this->payrolls = Payroll::with('employee.user')->latest()->get();
    }

    private function resetInputFields(){
        $this->department_id = '';
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
            'month' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'employee_id' => 'required',
            'month' => 'required',
        ]);

        $employee = Employee::findOrFail($this->employee_id);

        $basic = $employee->basic_salary;

        $monthStart = Carbon::parse($this->month)->startOfMonth();
        $monthEnd   = Carbon::parse($this->month)->endOfMonth();

        // Attendance
        $present = Attendance::where('employee_id',$employee->id)
            ->whereBetween('date',[$monthStart,$monthEnd])
            ->where('status','present')
            ->count();

        $halfDay = Attendance::where('employee_id',$employee->id)
            ->whereBetween('date',[$monthStart,$monthEnd])
            ->where('status','half_day')
            ->count();

        $absent = Attendance::where('employee_id',$employee->id)
            ->whereBetween('date',[$monthStart,$monthEnd])
            ->where('status','absent')
            ->count();

        // Approved Leave
        $leaveDays = Leave::where('employee_id',$employee->id)
            ->where('status','approved')
            ->whereBetween('start_date',[$monthStart,$monthEnd])
            ->sum('total_days');

        // Overtime
        $overtimeHours = Attendance::where('employee_id',$employee->id)
            ->whereBetween('date',[$monthStart,$monthEnd])
            ->sum('overtime_hours');

        // Salary Calculation
        $perDaySalary = $basic / 30;
        $deduction = ($perDaySalary * $absent) + ($halfDay * ($perDaySalary / 2));
        $perHourRate = $basic / (30 * 8);
        $overtimeAmount = round($perHourRate * $overtimeHours, 2);

        $net = round($basic + $this->bonus + $overtimeAmount - $deduction, 2);

        $payroll = Payroll::create([
            'employee_id'=>$employee->id,
            'month'=>$this->month,
            'basic_salary'=>$basic,
            'present_days'=>$present,
            'absent_days'=>$absent,
            'leave_days'=>$leaveDays,
            'overtime_hours'=>$overtimeHours,
            'overtime_amount'=>$overtimeAmount,
            'bonus'=>$this->bonus,
            'deduction'=>$deduction,
            'net_salary'=>$net,
        ]);

        return redirect('admin/hr/payrolls')->with('success', 'Payroll is successfully generated');
    }

    public function markPaid($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->update([
            'status'=>'paid',
            'paid_at'=>now()
        ]);

        return redirect('admin/hr/payrolls')->with('success', 'Payroll is successfully mark paid');
    }
    

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deletedPayroll()
    {
        try{
            $data = Payroll::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('payrolls')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leave type is deleted for information.");

            return redirect('admin/hr/payrolls')->with('success', 'Payroll is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Payroll deleted failed: ' . $e->getMessage());
        }
    }
}
