<?php

namespace App\Livewire\Backend\Admin\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ListComponent extends Component
{
    public $user_id;
    public $delete_id;

    public $name;
    public $email;
    public $phone;
    public $type;

    protected $listeners = [
        'deleteConfirmed' => 'deleteUser',
    ];

    public function render()
    {
        $this->dispatch('render-selectpicker');

        $users = User::latest()->get();

        return view('livewire.backend.admin.user.list-component', [
            'users' => $users,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Users | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->user_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->type = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        try{
            $user = User::create([
                'name'     => $this->name,
                'email'    => $this->email,
                'phone'    => $this->phone,
                'password' => Hash::make($this->email),
                'type'     => $this->type,
                'email_verified_at'  =>   now(),
                'account_status' => 1,
            ]);

            // Log the activity
            activity()
            ->useLog('user')
            ->event('created')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The user is created for information.");

            return redirect()->route('admin.users')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = User::findOrFail($id);

        $this->user_id = $edit->id;
        $this->name = $edit->name;
        $this->email = $edit->email;
        $this->phone = $edit->phone;
        $this->type = $edit->type;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try{
            $data = User::find($this->user_id);
            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            $data->password = Hash::make($this->email);
            $data->type = $this->type;
            $data->email_verified_at = now();
            $data->account_status = 1;
            $data->save();

            // Log the activity
            activity()
            ->useLog('user')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The user is updated for information.");

            return redirect()->route('admin.users')->with('success', 'Consignee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }

    public function statusClick($id, $status)
    {
        try{
            $data = User::find($id);
            $data->account_status = $status;
            $data->save();

            return redirect()->route('admin.users')->with('success', 'Consignee is successfully status!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteUser()
    {
        try{
            $data = User::find($this->delete_id);
            $data->account_status = 5;
            $data->save();

            // Log the activity
            activity()
            ->useLog('user')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The user is deleted for information.");

            return redirect()->route('admin.users')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
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
            ->useLog('user')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The user is updated for account status.");

            return redirect()->route('admin.users')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }


}