<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\Payroll;
use App\Models\User;

class EmployeePayrollList extends Component
{
    public $user;

    public $delete_id;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function mount($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        $data = $this->user->employee->payrolls;

        return view('livewire.backend.admin.user.employee-payroll-list', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Payrolls | Let's Go China",
        ]);
    }

    public function markPaid($id)
    {
        $payroll = Payroll::findOrFail($id);
        $payroll->update([
            'status'=>'paid',
            'paid_at'=>now()
        ]);

        return redirect()->route('admin.user.employee.payrolls', $this->user->id)->with('success', 'Payroll is successfully mark paid');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    public function delete()
    {
        try{
            $data = Payroll::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('payroll')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The payroll is deleted for information.");

            return redirect()->route('admin.user.employee.payrolls', $this->user->id)->with('success', 'Payroll is successfully deleted!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Payroll deleted failed: ' . $e->getMessage());
        }
    }
}
