<?php

namespace App\Livewire\Backend\Agent\Application;

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
        return view('livewire.backend.agent.application.view-component')
        ->layout('layouts.agent.app', [
            'title' => "Form View | Let's Go China",
        ]);
    }
}
