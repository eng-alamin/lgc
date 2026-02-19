<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;

class ApplicationViewComponent extends Component
{
    public $data;
    
    public function mount($id)
    {
        $this->data = Form::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.frontend.client.application-view-component')
        ->layout('layouts.client.app', [
            'title' => "Application View | Let's Go China"
        ]);
    }
}
