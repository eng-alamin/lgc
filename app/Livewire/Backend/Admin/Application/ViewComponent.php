<?php

namespace App\Livewire\Backend\Admin\Application;

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
        return view('livewire.backend.admin.application.view-component')
        ->layout('layouts.backend.app', [
            'title' => "Application View | Let's Go China",
        ]);
    }
}
