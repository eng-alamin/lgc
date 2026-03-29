<?php

namespace App\Livewire\Backend\Agent;

use Livewire\Component;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientComponent extends Component
{
    public $client_id;
    public $delete_id;

    public $name;
    public $email;
    public $phone;
    public $service;
    
    public $agent_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteClient',
    ];

    public function mount()
    {
        $this->agent_id = auth()->user()->agent->id;
    }

    public function render()
    {
        $this->dispatch('render-selectpicker');

        $clients = Client::where('agent_id', $this->agent_id)->latest()->get();

        return view('livewire.backend.agent.client-component', [
            'clients' => $clients,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Clients | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->client_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->service = '';
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
                'email_verified_at'  =>   now(),
                'account_status' => 1,
            ]);

            Client::create([
               'user_id' => $user->id,
               'agent_id' => $this->agent_id,
               'service' => $this->service,
            ]);

            // Log the activity
            activity()
            ->useLog('client')
            ->event('created')
            ->performedOn($user)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is created for information.");

            return redirect()->route('agent.clients')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Client::findOrFail($id);

        $this->client_id = $edit->id;
        $this->name = $edit->user->name;
        $this->email = $edit->user->email;
        $this->phone = $edit->user->phone;

        $this->service = $edit->service;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try{
            $data = Client::find($this->client_id);

            if ($data->user) {
                $data->user->name = $this->name;
                $data->user->email = $this->email;
                $data->user->phone = $this->phone;
                $data->user->password = Hash::make($this->email);
                $data->user->email_verified_at = now();
                $data->user->account_status = 1;
                $data->user->save();
            }

            $data->service = $this->service;
            $data->save();

            // Log the activity
            activity()
            ->useLog('client')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is updated for information.");

            return redirect()->route('agent.clients')->with('success', 'Consignee is successfully updated');
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

            return redirect()->route('agent.clients')->with('success', 'Client is successfully status!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Client updated failed: ' . $e->getMessage());
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
            $data->account_status = 5;
            $data->save();

            // Log the activity
            activity()
            ->useLog('client')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The client is deleted for information.");

            return redirect()->route('agent.clients')->with('success', 'Consignee is successfully deleted');
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

            return redirect()->route('agent.clients')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }


}