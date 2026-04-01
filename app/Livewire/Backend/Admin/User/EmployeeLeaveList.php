<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\Leave;
use App\Models\User;

class EmployeeLeaveList extends Component
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
        $data = $this->user->employee->leaves;

        return view('livewire.backend.admin.user.employee-leave-list', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Leaves | Let's Go China",
        ]);
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }

    public function delete()
    {
        try{
            $data = Leave::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('leave')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The leave is deleted for information.");

           return redirect()->route('admin.user.employee.leaves', $this->user->id)->with('success', 'Leave is successfully deleted!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Leave deleted failed: ' . $e->getMessage());
        }
    }
    public function toggleStatus($id, $status)
    {
        $data = Leave::findOrFail($id);
        $data->update([
            'status' => $status,
            'approved_by' => auth()->id()
        ]);
        return redirect()->route('admin.user.employee.leaves', $this->user->id)->with('success', 'Leave is successfully status updated!');
    }

}