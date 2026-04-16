<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class AgentComponent extends Component
{
    public $agent_id;
    public $delete_id;

    public $name;
    public $phone;
    public $email;
    public $type;
    public $commission_rate;

    protected $listeners = [
        'deleteConfirmed' => 'deleteAgent',
    ];

    public function mount()
    {
        $this->type = "individual";
        $this->commission_rate = 10;
    }
    public function render()
    {
        $this->dispatch('render-selectpicker');

        $data = Agent::latest()->get();

        return view('livewire.backend.admin.agent', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Agents | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->agent_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->type = '';
        $this->commission_rate = '';
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
            $data->type ='agent';
            $data->email_verified_at = now();
            $data->account_status = 1;
            $data->save();

            Agent::create([
               'user_id' => $data->id,
               'type' => $this->type,
               'commission_rate' => $this->commission_rate,
            ]);

            // Log the activity
            activity()
            ->useLog('agent')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is created for information.");

            return redirect()->route('admin.agents')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Agent::findOrFail($id);
        $this->agent_id = $edit->id;
        $this->name = $edit->user->name;
        $this->email = $edit->user->email;
        $this->phone = $edit->user->phone;
        $this->type = $edit->type;
        $this->commission_rate = $edit->commission_rate;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try{
            $data = Agent::find($this->agent_id);

            if ($data->user) {
                $data->user->name = $this->name;
                $data->user->email = $this->email;
                $data->user->phone = $this->phone;
                $data->user->password = Hash::make($this->email);
                $data->user->email_verified_at = now();
                $data->user->account_status = 1;
                $data->user->save();
            }

            $data->type = $this->type;
            $data->commission_rate = $this->commission_rate;
            $data->save();

            // Log the activity
            activity()
            ->useLog('agent')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is updated for information.");

            return redirect()->route('admin.agents')->with('success', 'Consignee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
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
            $data->delete();

            // Log the activity
            activity()
            ->useLog('agent')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The agent is deleted for information.");

            return redirect()->route('admin.agents')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }

    public function statusClick($id, $status)
    {
        try{
            $data = User::find($id);
            $data->account_status = $status;
            $data->save();

            return redirect()->route('admin.agents')->with('success', 'Agent is successfully status!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Agent updated failed: ' . $e->getMessage());
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

            return redirect()->route('admin.agents')->with('success', 'Consignee is successfully approved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee approved failed: ' . $e->getMessage());
        }
    }


}
