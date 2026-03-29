<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Client;
use App\Models\Form;

class ApplicationComponent extends Component
{
    public $client;

    public function mount()
    {
        $this->client = Client::where('user_id', auth()->id())->first();

        if (!$this->client) {
            abort(404, 'Client Not Found');
        }
    }


    public function render()
    {
        return view('livewire.frontend.client.application-component',[
            'documents' => $this->client->documents()->latest()->get()
        ])
        ->layout('layouts.client.app', [
            'title' => "Academic | Let's Go China"
        ]);
    }
}
