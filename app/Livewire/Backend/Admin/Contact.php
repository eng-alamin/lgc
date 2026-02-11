<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Contact as ContactModel;

class Contact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public $contact_id;
    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteContact',
    ];

    public function render()
    {
        $data = ContactModel::latest()->get();

        return view('livewire.backend.admin.contact', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Contacts | Let's Go China",
        ]);
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->subject = '';
        $this->message = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function view($id)
    {
        $view = ContactModel::findOrFail($id);

        $this->contact_id = $view->id;
        $this->name = $view->name;
        $this->email = $view->email;
        $this->phone = $view->phone;
        $this->subject = $view->subject;
        $this->message = $view->message;
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteContact()
    {
        try{
            $data = ContactModel::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('contact')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The contact is deleted for information.");

            return redirect()->route('admin.contacts')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }
}
