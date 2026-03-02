<?php

namespace App\Livewire\Backend\Admin\Hr;

use Livewire\Component;
use App\Models\Department;

class DepartmentComponent extends Component
{
    public $department_id;
    public $delete_id;

    public $name;
    public $description;
    public $status = true;

    protected $listeners = [
        'deleteConfirmed' => 'deletedDepartment',
    ];

    public function render()
    {
        $data = Department::get();

        return view('livewire.backend.admin.hr.department-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Departments | Let's Go China",
        ]);
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
            'name' => 'required|string|max:255',
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        try{
            $data = new Department();
            $data->name = $this->name;
            $data->description = $this->description;
            $data->status = $this->status;
            $data->save();

            // Log the activity
            activity()
            ->useLog('department')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The department is created for information.");


            return redirect('admin/hr/departments')->with('success', 'Department is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Department updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Department::findOrFail($id);
        $this->department_id = $edit->id;
        $this->name = $edit->name;
        $this->description = $edit->description;
        $this->status = $edit->status;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        try{
            $data = Department::find($this->department_id);
            $data->name = $this->name;
            $data->description = $this->description;
            $data->status = $this->status;
            $data->save();

            // Log the activity
            activity()
            ->useLog('department')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The department is updated for information.");

            return redirect('admin/hr/departments')->with('success', 'Department is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Department updated failed: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $department = Department::findOrFail($id);
        $department->update([
            'status' => !$department->status
        ]);
        return redirect('admin/hr/departments')->with('success', 'Department is successfully status');
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deletedDepartment()
    {
        try{
            $data = Department::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('department')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The department is deleted for information.");

            return redirect('admin/hr/departments')->with('success', 'Department is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Department deleted failed: ' . $e->getMessage());
        }
    }
}