<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\Team as TeamModel;
use App\Models\Subscriber;
use App\Mail\SendSubscribeMail;
use Mail;

class Team extends Component
{
    public $subscribe_email;

    public function render()
    {
        $sections = Section::get();
        $data = TeamModel::get();

        return view('livewire.frontend.team',[
             'sections' => $sections,
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Teams | Let's Go China"
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
