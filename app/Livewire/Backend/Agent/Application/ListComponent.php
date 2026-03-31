<?php

namespace App\Livewire\Backend\Agent\Application;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;

class ListComponent extends Component
{
    public $application_id;
    public $delete_id;

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function render()
    {
        $data = Form::where('agent_id', auth()->user()->agent->id)->latest()->get();

        return view('livewire.backend.agent.application.list-component', [
            'data' => $data,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Registration Forms | Let's Go China",
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
            $data = Form::find($this->delete_id);
            $data->delete();

            return redirect()->route('agent.application.list')->with('success', 'Application is successfully deleted!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Application deleted failed: ' . $e->getMessage());
        }
    }
}
