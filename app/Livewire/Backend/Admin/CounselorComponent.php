<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Counselor;
use Illuminate\Support\Facades\Hash;

class CounselorComponent extends Component
{
    public $counselor_id;
    public $delete_id;

    public $name;
    public $phone;
    public $email;

    protected $listeners = [
        'deleteConfirmed' => 'deleteCounselor',
    ];

    public function render()
    {
        $data = Counselor::latest()->get();

        return view('livewire.backend.admin.counselor-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Counselors | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->counselor_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->phone = '';
        $this->email = '';
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
            $data = new User();
            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            $data->password = Hash::make($this->email);
            $data->type = "counselor";
            $data->email_verified_at = now();
            $data->account_status = 1;
            $data->save();

            Counselor::create([
               'user_id' => $data->id,
            ]);

            // Log the activity
            activity()
            ->useLog('counselor')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The counselor is created for information.");

            return redirect()->route('admin.counselors')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Counselor::findOrFail($id);
        $this->counselor_id = $edit->id;
        $this->name = $edit->user->name;
        $this->email = $edit->user->email;
        $this->phone = $edit->user->phone;  
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try{
            $data = Counselor::find($this->counselor_id);

            if ($data->user) {
                $data->user->name = $this->name;
                $data->user->email = $this->email;
                $data->user->phone = $this->phone;
                $data->user->password = Hash::make($this->email);
                $data->user->email_verified_at = now();
                $data->user->account_status = 1;
                $data->user->save();
            }

            // $data->ran = $this->ran;
            // $data->ran = $this->ran;
            // $data->ran = $this->ran;
            // $data->save();

            // Log the activity
            activity()
            ->useLog('counselor')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The counselor is updated for information.");

            return redirect()->route('admin.counselors')->with('success', 'Consignee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteCounselor()
    {
        try{
            $data = User::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('counselor')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The counselor is deleted for information.");

            return redirect()->route('admin.counselors')->with('success', 'Consignee is successfully deleted');
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
            ->useLog('client')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is updated for account status.");

            return redirect()->route('admin.client.list')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }


}
