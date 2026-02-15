<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section;
use App\Models\Casestudy as CasestudyModel;
use App\Models\Subscriber;
use App\Mail\SendSubscribeMail;
use Mail;

class Casestudy extends Component
{
    public function render()
    {
        $sections = Section::get();
        $data = CasestudyModel::get();

        return view('livewire.frontend.casestudy',[
            'sections' => $sections,
            'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Case Studies | Let's Go China"
        ]);
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
