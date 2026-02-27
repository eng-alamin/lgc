<?php

namespace App\Livewire\Backend\Receptionist;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\User;

class AppointmentComponent extends Component
{
    public $client_id;
    public $agent_id;
    public $appointment_date;
    public $appointment_time;
    public $service;
    public $type = 'office';
    public $notes;

    public $appointment_id;
    public $delete_id;

        protected $listeners = [
        'deleteConfirmed' => 'deleteAppointment',
    ];

    public function render()
    {
        $data = Appointment::latest()->get();
        $clients = User::where('type', 'client')->get();
        $agents = User::where('type', 'agent')->get();

        return view('livewire.backend.receptionist.appointment-component', [
            'data' => $data,
            'clients' => $clients,
            'agents' => $agents,
        ])
        ->layout('layouts.receptionist.app', [
            'title' => "Appointments | Let's Go China",
        ]);
    }
    
   private function resetInputFields()
    {
        $this->client_id = '';
        $this->agent_id = '';
        $this->appointment_date = '';
        $this->appointment_time = '';
        $this->service = '';
        $this->type = '';
        $this->notes = '';
    }

    public function close()
    {
        $this->resetInputFields();
    }

    public function updated($name)
    {
        $this->validateOnly($name, [
            'client_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'agent_id' => 'nullable|exists:users,id',
        ]);
    }

    public function store()
    {
        $this->validate([
            'client_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'agent_id' => 'nullable|exists:users,id',
        ]);

        try{

            // Double booking manual check
            $exists = Appointment::where('agent_id', $this->agent_id)
                ->where('appointment_date', $this->appointment_date)
                ->where('appointment_time', $this->appointment_time)
                ->exists();

            if ($exists) {
                $this->addError('appointment_time', 'Agent already booked at this time.');
                return;
            }

            Appointment::create([
                'client_id' => $this->client_id,
                'agent_id' => $this->agent_id,
                'created_by' => auth()->id(),
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'type' => $this->type,
                'service' => $this->service,
                'notes' => $this->notes,
            ]);

            return redirect()->route('receptionist.appointments')->with('success', 'Data Created Successfully.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data created failed: ' . $e->getMessage());
        }
    }

    // public function view($id)
    // {
    //     $view = Appointment::findOrFail($id);

    //     $this->appointment_id = $view->id;
    //     $this->date = $view->date;
    //     $this->name = $view->name;
    //     $this->email = $view->email;
    //     $this->phone = $view->phone;
    //     $this->address = $view->address;
    //     $this->message = $view->message;
    //     $this->service = $view->service;
    // }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('showDeleteConfirmation');
    }
    public function deleteAppointment()
    {
        try{
            $data = Appointment::find($this->delete_id);
            $data->delete();

            // Log the activity
            activity()
            ->useLog('appointment')
            ->event('deleted')
            ->performedOn($data)
            ->causedBy(auth()->user())
            ->withProperties(['ip' => request()->ip(), 'browser' => request()->userAgent()])
            ->log("The appointment is deleted for information.");

            return redirect()->route('receptionist.appointments')->with('success', 'Consignee is successfully deleted');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Consignee deleted failed: ' . $e->getMessage());
        }
    }

}