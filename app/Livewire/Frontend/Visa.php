<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\Visa as VisaModel;
use App\Models\Subscriber;
use App\Mail\SendSubscribeMail;
use Mail;

class Visa extends Component
{
    public $subscribe_email;

    public function render()
    {
        $sections = Section::get();
        $data = VisaModel::get();

        return view('livewire.frontend.visa',[
             'sections' => $sections,
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Visa | Let's Go China"
        ]);
    }

    private function resetInputFields()
    {
        $this->subscribe_email = '';
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
