<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Form;

class DashboardComponent extends Component
{
    public $form_total;
    public $form_process;
    public $form_approved;
    public $form_rejected;

    public function mount()
    {
        $this->form_total = Form::where('user_id', auth()->id())->count();
        $this->form_process = Form::where('user_id', auth()->id())->where('status', 'processing')->count();
        $this->form_approved = Form::where('user_id', auth()->id())->where('status', 'approved')->count();
        $this->form_rejected = Form::where('user_id', auth()->id())->where('status', 'rejected')->count();
    }

    public function render()
    {
        $forms = Form::where('user_id', auth()->id())->latest()->take(8)->with('formStatuses')->get();

        return view('livewire.frontend.client.dashboard-component',[
            'forms' => $forms,
        ])
        ->layout('layouts.client.app', [
            'title' => "Dashboard | Let's Go China"
        ]);
    }
}
