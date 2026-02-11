<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Client extends Component
{
    public $client_id;
    public $delete_id;

    public $name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $postal;

    protected $listeners = [
        'deleteConfirmed' => 'deleteClient',
    ];

    public function render()
    {
        $data = User::where('type', 'user')->latest()->get();

        return view('livewire.backend.admin.client', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Clients | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->client_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';
        $this->postal = '';
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
            $json_data = json_encode([
                'address' =>  $this->address,
                'city' =>  $this->city,
                'postal' =>  $this->postal,
            ]);
            $data = new User();
            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            $data->password = Hash::make($this->email);
            $data->data = $json_data;
            $data->email_verified_at = now();
            $data->account_status = 1;
            $data->save();

            // Log the activity
            activity()
            ->useLog('client')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is created for information.");

            return redirect()->route('admin.clients')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $json_data = json_decode($edit->data);

        $this->client_id = $edit->id;
        $this->name = $edit->name;
        $this->email = $edit->email;
        $this->phone = $edit->phone;
        $this->address = $json_data->address;
        $this->city = $json_data->city;
        $this->postal = $json_data->postal;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try{
            $data = User::find($this->client_id);

            $json_data = json_encode([
                'address' =>  $this->address,
                'city' =>  $this->city,
                'postal' =>  $this->postal,
            ]);

            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            $data->password = Hash::make($this->email);
            $data->data = $json_data;
            $data->email_verified_at = now();
            $data->account_status = 1;
            $data->save();

            // Log the activity
            activity()
            ->useLog('client')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is updated for information.");

            return redirect()->route('admin.clients')->with('success', 'Consignee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteClient()
    {
        try{
            $data = User::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('client')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is deleted for information.");

            return redirect()->route('admin.clients')->with('success', 'Consignee is successfully deleted');
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

            return redirect()->route('admin.clients')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }


}