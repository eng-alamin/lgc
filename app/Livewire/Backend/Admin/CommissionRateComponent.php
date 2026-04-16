<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\CommissionRate;

class CommissionRateComponent extends Component
{
    public $rate_id;
    public $delete_id;

    public $type;
    public $value;

    protected $listeners = [
        'deleteConfirmed' => 'delete',
    ];

    public function render()
    {
        $this->dispatch('refreshSelect');

        $data = CommissionRate::latest()->get();

        return view('livewire.backend.admin.commission-rate-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Commission Rulse | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->rate_id = '';
        $this->delete_id = '';

        $this->type = '';
        $this->value = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'type' => 'required|unique:commission_rates',
            'value' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'type' => 'required|unique:commission_rates',
            'value' => 'required',
        ]);

        try{
            $data = new CommissionRate();
            $data->type = $this->type;
            $data->value = $this->value;
            $data->save();

            // Log the activity
            activity()
            ->useLog('commission')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The commission rate is created for information.");

            return redirect()->route('admin.commission.rates')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = CommissionRate::findOrFail($id);
        $json_data = json_decode($edit->data);

        $this->rate_id = $edit->id;
        $this->type = $edit->type;
        $this->value = $edit->value;
    }
    public function update()
    {
        $this->validate([
            'type' => ['required', rate::unique('commission_rates', 'type')->ignore($this->rate_id)],
            'value' => 'required',
        ]);

        try{
            $data = CommissionRate::find($this->rate_id);
            $data->type = $this->type;
            $data->value = $this->value;
            $data->save();

            // Log the activity
            activity()
            ->useLog('commission')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The commission rate is updated for information.");

            return redirect()->route('admin.commission.rates')->with('success', 'Consignee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
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
            $data = CommissionRate::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('commission')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The commission rates is deleted for information.");

            return redirect()->route('admin.commission.rates')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }


    public function statusClick($id, $status)
    {
        try{
            $data = CommissionRate::find($id);
            $data->status = $status;
            $data->save();

            return redirect()->route('admin.commission.rates')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }


}
