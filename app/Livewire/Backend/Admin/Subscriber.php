<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Subscriber as SubscriberModel;

class Subscriber extends Component
{
    public $subscriber_id;
    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteSubscriber',
    ];

    public function render()
    {
        $data = SubscriberModel::latest()->get();

        return view('livewire.backend.admin.subscriber', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Subscribers | Let's Go China",
        ]);
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteSubscriber()
    {
        try{
            $data = SubscriberModel::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('subscriber')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The subscriber is deleted for information.");

            return redirect()->route('admin.subscribers')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }
}
