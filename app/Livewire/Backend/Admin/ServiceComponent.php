<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceComponent extends Component
{
    public $service_id;
    public $delete_id;

    public $name;

    protected $listeners = [
        'deleteConfirmed' => 'deleted',
    ];

    public function render()
    {
        return view('livewire.backend.admin.service-component',[
            'services' => Service::get(),
        ])
        ->layout('layouts.backend.app', [
            'title' => "Services | Let's Go China"
        ]);
    }

    private function resetInputFields(){
        $this->service_id = '';
        $this->delete_id = '';

        $this->name = '';
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
            $data = new Service();
            $data->slug = Str::slug($this->name);
            $data->name = $this->name;
            $data->save();

            // Log the activity
            activity()
            ->useLog('service')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The service is created for information.");


            return redirect('admin/services')->with('success', 'Service is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Service updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = Service::findOrFail($id);
        $this->service_id = $edit->id;
        $this->name = $edit->name;
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        try{
            $data = Service::find($this->service_id);
            $data->slug = Str::slug($this->name);
            $data->name = $this->name;
            $data->save();

            // Log the activity
            activity()
            ->useLog('service')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The department is updated for information.");

            return redirect('admin/services')->with('success', 'Service is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Service updated failed: ' . $e->getMessage());
        }
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleted()
    {
        try{
            $data = Service::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('service')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The service is deleted for information.");

            return redirect('admin/services')->with('success', 'Service is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Service deleted failed: ' . $e->getMessage());
        }
    }
}
