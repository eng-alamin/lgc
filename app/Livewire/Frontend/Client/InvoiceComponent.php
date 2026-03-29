<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Client;

class InvoiceComponent extends Component
{
    public Client $client;

    public $invoices;

    public function mount()
    {
        $this->client = Client::where('user_id', auth()->id())->first();
        
        if (!$this->client) {
            abort(404, 'Client Not Found');
        }

        $this->invoices = $this->client->invoices()->latest()->get();
    }

    public function render()
    {
        return view('livewire.frontend.client.invoice-component')
        ->layout('layouts.client.app', [
            'title' => "Academic | Let's Go China"
        ]);
    }
}
