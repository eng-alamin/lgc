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
        $data = Form::where('agent_id', auth()->id())->latest()->get();

        return view('livewire.backend.agent.application.list-component', [
            'data' => $data,
        ])
        ->layout('layouts.agent.app', [
            'title' => "Application List | Let's Go China",
        ]);
    }

    public function statusClick($id, $status)
    {
        try{
            $data = Form::find($id);
            $data->status = $status;
            $data->save();

            $history = new StatusHistory();
            $history->module = 'form';
            $history->module_id = $data->id;
            $history->status = $status;
            $history->save();

            return redirect()->route('agent.application.list')->with('success', 'Application is successfully status!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Application updated failed: ' . $e->getMessage());
        }
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
