<?php

namespace App\Livewire\Backend\Employee;

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
    public $payroll;

    public function render()
    {
        $payrolls = Payroll::with('employee.user')
            ->where('employee_id', auth()->user()->employee->id)
            ->latest()
            ->get();

        return view('livewire.backend.employee.payroll-component', [
            'payrolls' => $payrolls,
        ])
        ->layout('layouts.employee.app', [
            'title' => "Payrolls | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->payroll = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function view($id)
    {
        $this->payroll = Payroll::with('employee.user')->findOrFail($id);
    }
}
