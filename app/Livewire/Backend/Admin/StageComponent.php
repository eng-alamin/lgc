<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Stage;

class StageComponent extends Component
{
    public $stage_id;
    public $delete_id;

    public $name;
    public $icon;
    public $order;
    public $progress_percent;

    protected $listeners = [
        'deleteConfirmed' => 'deletedStage',
    ];

    public function mount()
    {
        $stage = Stage::orderByDesc('order')->first();
        $this->order = $stage ? $stage->order + 1 : 1;
    }

    public function render()
    {
        return view('livewire.backend.admin.stage-component',[
            'stages' => Stage::orderBy('order')->get(),
        ])
        ->layout('layouts.backend.app', [
            'title' => "Stages | Let's Go China"
        ]);
    }

    private function resetInputFields(){
        $this->stage_id = '';
        $this->delete_id = '';

        $this->name = '';
        $this->icon = '';
        $this->order = '';
        $this->progress_percent = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'name' => 'required|string|max:255',
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        try{
            $data = new Stage();
            $data->type = $this->name;
            $data->name = $this->name;
            $data->icon = $this->icon;
            $data->order = $this->order;
            $data->progress_percent = $this->progress_percent;
            $data->save();

            // Log the activity
            activity()
            ->useLog('stage')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The stage is created for information.");


            return redirect('admin/stages')->with('success', 'Stage is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Stage updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Stage::findOrFail($id);
        $this->stage_id = $edit->id;
        $this->name = $edit->name;
        $this->icon = $edit->icon;
        $this->order = $edit->order;
        $this->progress_percent = $edit->progress_percent;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        try{
            $data = Stage::find($this->stage_id);

            if($data->type == 'lead' || $data->type == 'invoice' || $data->type == 'documentation' || $data->type == 'application' || $data->type == 'visa' || $data->type == 'flight' || $data->type == 'mission'){
                $data->type = $data->type;
            }else{
               $data->type = $this->name;
            }
            
            $data->name = $this->name;
            $data->icon = $this->icon;
            $data->order = $this->order;
            $data->progress_percent = $this->progress_percent;
            $data->save();

            // Log the activity
            activity()
            ->useLog('stage')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The department is updated for information.");

            return redirect('admin/stages')->with('success', 'Stage is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Stage updated failed: ' . $e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deletedStage()
    {
        try{
            $data = Stage::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('stage')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The stage is deleted for information.");

            return redirect('admin/stages')->with('success', 'Stage is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Stage deleted failed: ' . $e->getMessage());
        }
    }
}