<?php

namespace App\Livewire\Backend\Receptionist\Application;

use Livewire\Component;
use App\Models\Form;
use App\Models\StatusHistory;

class ViewComponent extends Component
{
    public $data;
    
    public function mount($id)
    {
        $this->data = Form::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.backend.receptionist.application.view-component')
        ->layout('layouts.receptionist.app', [
            'title' => "Application View | Let's Go China",
        ]);
    }
}
