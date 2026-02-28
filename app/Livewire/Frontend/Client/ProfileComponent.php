<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Form;

class ProfileComponent extends Component
{
    public function render()
    {
        $data = Form::where('client_id', auth()->id())->first();

        return view('livewire.frontend.client.profile-component',[
            'data' => $data,
        ])
        ->layout('layouts.client.app', [
            'title' => "Profile | Let's Go China"
        ]);
    }
}
