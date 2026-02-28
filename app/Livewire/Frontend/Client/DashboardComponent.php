<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Form;

class DashboardComponent extends Component
{

    public function mount()
    {
        
    }

    public function render()
    {
        $forms = Form::where('client_id', auth()->id())->latest()->take(8)->with('formStatuses')->get();

        return view('livewire.frontend.client.dashboard-component',[
            'forms' => $forms,
        ])
        ->layout('layouts.client.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }
}
