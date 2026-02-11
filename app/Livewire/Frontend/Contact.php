<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Contact as ContactModel;
use App\Models\Subscriber;
use App\Models\Section;
use App\Mail\ReceiveContactMail;
use App\Mail\SendSubscribeMail;
use Mail;

class Contact extends Component
{
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public $subscribe_email;

    public function render()
    {
        $sections = Section::get();

        $locations = [
            ["lat" => 23.8295439928878, "lng" => 90.41870238759184],
            // ["lat" => 22.5539568, "lng" => 113.429923],
          ];

        return view('livewire.frontend.contact', [
            'sections' => $sections,
            'locations' => $locations,
            ])
            ->layout('layouts.frontend.app', [
                'title' => "Contact Us | Let's Go China"
            ]);
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:20',
        'subject' => 'nullable|string',
        'message' => 'nullable|string',
    ];

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->subject = '';
        $this->message = '';
        $this->subscribe_email = '';
    }

    public function store()
    {
        $this->validate();

        $email = config('setting.to_mail');
        $maildata = [
            'subject' => 'Receive Contact Mail',
            'greeting' => 'Hi Dear',
            'title' => $this->subject.' from '.$this->email,
            'body' => $this->message,
            'thanks' => 'Thank you',
        ];

        Mail::to($email)->cc(config('setting.cc_mail'))->send(new ReceiveContactMail($maildata));

        ContactModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->resetInputFields();
        session()->flash('success', 'Contact request submitted successfully!');
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
