<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Employee extends Component
{
    public $employees;

    public $employee_id;
    public $delete_id;

    public $name;
    public $email;
    public $phone;
    public $password;

    protected $listeners = [
        'deleteConfirmed' => 'deleteEmployee',
    ];


    public function render()
    {
        $data = User::where('type', 'admin')->latest()->get();

        return view('livewire.backend.admin.employee', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Employees | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->employee_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        try{
            $data = new User();
            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            $data->type = 'admin';
            $data->password = Hash::make($this->password);
            $data->email_verified_at = now();
            $data->save();

            // if($this->type == 'admin'){
            //     $data->assignRole('admin');
            // }else{
            //     $data->assignRole('employee');
            // }

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is created for information.");


            return redirect('admin/employees')->with('success', 'Employee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Employee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $this->employee_id = $edit->id;
        $this->name = $edit->name;
        $this->email = $edit->email;
        $this->phone = $edit->phone;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        try{
            $data = User::find($this->employee_id);
            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            if($this->password){
                $data->password = Hash::make($this->password);
            }
            $data->save();

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is updated for information.");

            return redirect('admin/employees')->with('success', 'Employee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Employee updated failed: ' . $e->getMessage());
        }
    }
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteEmployee()
    {
        try{
            $data = User::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is deleted for information.");

            return redirect('admin/employees')->with('success', 'Employee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Employee deleted failed: ' . $e->getMessage());
        }
    }
}
