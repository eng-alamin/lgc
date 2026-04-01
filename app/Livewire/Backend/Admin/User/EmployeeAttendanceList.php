<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\Attendance;
use App\Models\User;

class EmployeeAttendanceList extends Component
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
        $data = $this->user->employee->attendances;

        return view('livewire.backend.admin.user.employee-attendance-list', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Attendances | Let's Go China",
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

            return redirect()->route('admin.user.employee.attendances', $this->user->id)->with('success', 'Attendance is successfully deleted!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Attendance deleted failed: ' . $e->getMessage());
        }
    }
}
