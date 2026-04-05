<?php

namespace App\Livewire\Backend\Admin\Hr\Employee;

use Livewire\Component;
use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class IndexComponent extends Component
{
    public $employees;

    public $employee_id;
    public $delete_id;

    public $name, $email, $phone, $password;
    public $id_number, $department_id, $designation;
    public $basic_salary, $allowance;
    public $employment_type = 'full_time';
    public $status = 'active';

    protected $listeners = [
        'deleteConfirmed' => 'deleteEmployee',
    ];

    public function render()
    {
        $this->dispatch('refreshSelect');

        $data = Employee::with('user','department')->latest()->get();
        $departments = Department::all();

        return view('livewire.backend.admin.hr.employee.index-component', [
            'data' => $data,
            'departments' => $departments,
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
        $this->id_number = '';
        $this->department_id = '';
        $this->designation = '';
        $this->basic_salary = '';
        $this->allowance = '';
        $this->employment_type = '';
        $this->status = '';
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
            'department_id' => 'required',
            'designation' => 'required',
            'basic_salary' => 'nullable|numeric',
            'allowance' => 'nullable|numeric',
            

        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'department_id' => 'required',
            'designation' => 'required',
            'basic_salary' => 'nullable|numeric',
            'allowance' => 'nullable|numeric',
        ]);

        try{

            $user = User::create([
                'name'=>$this->name,
                'email'=>$this->email,
                'phone'=>$this->phone,
                'password'=>Hash::make($this->password ?? '12345678'),
                'type'=>'employee',
            ]);

             $employee = Employee::create([
                'user_id'=>$user->id,
                'id_number'=>'L3G6CE'.str_pad(Employee::count()+1,3,'0',STR_PAD_LEFT),
                'department_id'=>$this->department_id,
                'designation'=>$this->designation,
                'basic_salary'=>$this->basic_salary ?? 0,
                'allowance'=>$this->allowance ?? 0,
                'join_date'=>now(),
                'employment_type'=>$this->employment_type,
                'status'=>$this->status,
            ]);

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('created')
            ->performedOn($employee)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is created for information.");


            return redirect('admin/hr/employees')->with('success', 'Employee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Employee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Employee::with('user')->findOrFail($id);
        $this->employee_id = $edit->id;
        $this->name = $edit->user->name;
        $this->email = $edit->user->email;
        $this->phone = $edit->user->phone;
        $this->id_number = $edit->id_number;
        $this->department_id = $edit->department_id;
        $this->designation = $edit->designation;
        $this->basic_salary = $edit->basic_salary;
        $this->allowance = $edit->allowance;
        $this->employment_type = $edit->employment_type;
        $this->status = $edit->status;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'id_number' => 'required',
            'department_id' => 'required',
            'designation' => 'required',
            'basic_salary' => 'nullable|numeric',
            'allowance' => 'nullable|numeric',
        ]);

        try{
            $employee = Employee::findOrFail($this->employee_id);
            $user = $employee->user;

            $user->update([
                'name' => $this->name,
                'email' => $this->email,
                'phone'=>$this->phone,
            ]);

            if($this->password){
                $user->update(['password'=>Hash::make($this->password)]);
            }

            $employee->update([
                'id_number'=>$this->id_number,
                'department_id'=>$this->department_id,
                'designation'=>$this->designation,
                'basic_salary'=>$this->basic_salary ?? 0,
                'allowance'=>$this->allowance ?? 0,
                'employment_type'=>$this->employment_type,
                'status'=>$this->status,
            ]);

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('updated')
            ->performedOn($employee)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is updated for information.");

            return redirect('admin/hr/employees')->with('success', 'Employee is successfully updated');
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
            $employee = Employee::findOrFail($this->delete_id);
            $employee->user->delete(); // cascade

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('deleted')
            ->performedOn($employee)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is deleted for information.");

            return redirect('admin/hr/employees')->with('success', 'Employee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Employee deleted failed: ' . $e->getMessage());
        }
    }

    public function statusClick($id, $status)
    {
        try{
            $data = User::find($id);
            $data->account_status = $status;
            $data->save();

            return redirect()->route('admin.hr.employees')->with('success', 'Consignee is successfully status!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }

    public function approved($id)
    {
        try{
            $data = User::find($id);
            $data->account_status = '1';
            $data->update();

            // Log the activity
            activity()
            ->useLog('employee')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The employee is updated for account status.");

            return redirect()->route('admin.hr.employees')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }
}