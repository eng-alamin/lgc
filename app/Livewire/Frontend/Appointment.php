<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Appointment as AppointmentModel;

class Appointment extends Component
{
    public $date;
    public $name, $email, $phone, $address, $message;
    public $service;

    public function render()
    {
        return view('livewire.frontend.appointment')
        ->layout('layouts.frontend.app', [
            'title' => "Appointment | Let's Go China"
        ]);
    }

    protected $rules = [
        'date' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string',
        'message' => 'nullable|string',
        'service' => 'required',
    ];

    private function resetInputFields()
    {
        $this->date = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->address = '';
        $this->message = '';
        $this->service = '';
    }

    public function store()
    {
        $this->validate();

        AppointmentModel::create([
            'date' => $this->date,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'message' => $this->message,
            'service' => $this->service,
        ]);

        $this->resetInputFields();
        session()->flash('success', 'Appointment request submitted successfully!');
    }
}
