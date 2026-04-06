<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section;
use App\Models\Appointment as AppointmentModel;
use App\Models\Subscriber;
use App\Mail\SendSubscribeMail;
use Mail;

class Appointment extends Component
{
    public $date;
    public $name, $email, $phone, $address, $message;
    public $service;

    public $subscribe_email;

    public function render()
    {
        $sections = Section::get();

        return view('livewire.frontend.appointment',[
            'sections' => $sections,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Appointment | Let's Go China",
            'seo' => [
                'title' => "Appointment | Let's Go China",
                'description' => config('setting.detail'),
                'image' => asset(config('setting.logo')),
                'url' => url('/'),
                'type' => 'website',
            ],
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

        $this->subscribe_email = '';
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

    public function subscribe()
    {
        $this->validate([
            'subscribe_email' => 'required|email|unique:subscribers,email',
        ]);

        $maildata = Subscriber::create([
            'email' => $this->subscribe_email,
        ]);

        // Send confirmation mail
        Mail::to($this->subscribe_email)->send(new SendSubscribeMail($maildata));

       $this->resetInputFields();
        session()->flash('success', 'Subscribed successfully!');
    }
}
