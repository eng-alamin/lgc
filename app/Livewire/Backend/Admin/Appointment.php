<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\Appointment as AppointmentModel;

class Appointment extends Component
{
    public $date;
    public $name;
    public $email;
    public $phone;
    public $address;
    public $message;
    public $service;

    public $appointment_id;
    public $delete_id;

    protected $listeners = [
        'deleteConfirmed' => 'deleteAppointment',
    ];

    public function render()
    {
        $data = AppointmentModel::latest()->get();

        return view('livewire.backend.admin.appointment', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Appointments | Let's Go China",
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
        $view = AppointmentModel::findOrFail($id);

        $this->appointment_id = $view->id;
        $this->date = $view->date;
        $this->name = $view->name;
        $this->email = $view->email;
        $this->phone = $view->phone;
        $this->address = $view->address;
        $this->message = $view->message;
        $this->service = $view->service;
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteAppointment()
    {
        try{
            $data = AppointmentModel::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('appointment')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The appointment is deleted for information.");

            return redirect()->route('admin.appointments')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }

}
