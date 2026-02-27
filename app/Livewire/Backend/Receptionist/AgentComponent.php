<?php

namespace App\Livewire\Backend\Receptionist;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgentComponent extends Component
{
    public $agent_id;
    public $delete_id;

    public $name;
    public $phone;
    public $email;
    public $address;
    public $city;
    public $postal;
    public $website;


    protected $listeners = [
        'deleteConfirmed' => 'deleteAgent',
    ];

    public function render()
    {
        $data = User::where('type', 'agent')->latest()->get();

        return view('livewire.backend.receptionist.agent-component', [
            'data' => $data,
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Agents | Let's Go China",
        ]);
    }


    private function resetInputFields(){
        $this->agent_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->address = '';
        $this->city = '';
        $this->state = '';
        $this->postal = '';
        $this->website = '';
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
                'website' =>  $this->website,
            ]);
            $data = new User();
            $data->name = $this->name;
            $data->email = $this->email;
            $data->phone = $this->phone;
            $data->type = 'agent';
            $data->password = Hash::make($this->email);
            $data->data = $json_data;
            $data->email_verified_at = now();
            $data->account_status = 1;
            $data->save();

            // Log the activity
            activity()
            ->useLog('agent')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is created for information.");

            return redirect()->route('receptionist.agents')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = User::findOrFail($id);
        $json_data = json_decode($edit->data);

        $this->agent_id = $edit->id;
        $this->name = $edit->name;
        $this->email = $edit->email;
        $this->phone = $edit->phone;
        $this->address = $json_data->address;
        $this->city = $json_data->city;
        $this->postal = $json_data->postal;
        $this->website = $json_data->website ?? '';
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try{
            $data = User::find($this->agent_id);

            $json_data = json_encode([
                'address' =>  $this->address,
                'city' =>  $this->city,
                'postal' =>  $this->postal,
                'website' =>  $this->website,
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
            ->useLog('agent')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is updated for information.");

            return redirect()->route('receptionist.agents')->with('success', 'Consignee is successfully updated');
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

            return redirect()->route('receptionist.agents')->with('success', 'Agent is successfully status!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Agent updated failed: ' . $e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteAgent()
    {
        try{
            $data = User::find($this->delete_id);
            $data->account_status = 5;
            $data->save();

            // Log the activity
            activity()
            ->useLog('agent')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is deleted for information.");

            return redirect()->route('receptionist.agents')->with('success', 'Consignee is successfully deleted');
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
            ->useLog('agent')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is updated for account status.");

            return redirect()->route('receptionist.agents')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }


}
