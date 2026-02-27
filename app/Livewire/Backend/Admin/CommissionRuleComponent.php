<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\CommissionRule;

class CommissionRuleComponent extends Component
{
    public $rule_id;
    public $delete_id;

    public $service_type;
    public $commission_type;
    public $commission_value;

    protected $listeners = [
        'deleteConfirmed' => 'deleteRule',
    ];

    public function render()
    {
        $this->dispatch('refreshSelect');

        $data = CommissionRule::latest()->get();

        return view('livewire.backend.admin.commission-rule-component', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Commission Rulse | Let's Go China",
        ]);
    }

    private function resetInputFields(){
        $this->rule_id = '';
        $this->delete_id = '';

        $this->service_type = '';
        $this->commission_type = '';
        $this->commission_value = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'service_type' => 'required|unique:commission_rules',
            'commission_type' => 'required',
            'commission_value' => 'required',
        ]);
    }

    public function store()
    {
        $this->validate([
            'service_type' => 'required|unique:commission_rules',
            'commission_type' => 'required',
            'commission_value' => 'required',
        ]);

        try{
            $data = new CommissionRule();
            $data->service_type = $this->service_type;
            $data->commission_type = $this->commission_type;
            $data->commission_value = $this->commission_value;
            $data->save();

            // Log the activity
            activity()
            ->useLog('commission')
            ->event('created')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The commission rule is created for information.");

            return redirect()->route('admin.commission.rules')->with('success', 'Consignee is successfully saved');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function edit($id)
    {
        $edit = CommissionRule::findOrFail($id);
        $json_data = json_decode($edit->data);

        $this->rule_id = $edit->id;
        $this->service_type = $edit->service_type;
        $this->commission_type = $edit->commission_type;
        $this->commission_value = $edit->commission_value;
    }
    public function update()
    {
        $this->validate([
            'service_type' => 'required|unique:commission_rules',
            'commission_type' => 'required',
            'commission_value' => 'required',
        ]);

        try{
            $data = CommissionRule::find($this->rule_id);
            $data->service_type = $this->service_type;
            $data->commission_type = $this->commission_type;
            $data->commission_value = $this->commission_value;
            $data->save();

            // Log the activity
            activity()
            ->useLog('commission')
            ->event('updated')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The commission rule is updated for information.");

            return redirect()->route('admin.commission.rules')->with('success', 'Consignee is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteRule()
    {
        try{
            $data = CommissionRule::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('commission')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The commission rules is deleted for information.");

            return redirect()->route('admin.commission.rules')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }


    public function statusClick($id, $status)
    {
        try{
            $data = CommissionRule::find($id);
            $data->status = $status;
            $data->save();

            return redirect()->route('admin.commission.rules')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee updated failed: ' . $e->getMessage());
        }
    }


}