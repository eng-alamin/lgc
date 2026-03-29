<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Notice;

class NoticeViewComponent extends Component
{
    public $notice;
    
    public function mount($id)
    {
        $this->notice = Notice::find($id);
    }
    public function render()
    {
        return view('livewire.frontend.client.notice-view-component')
        ->layout('layouts.client.app', [
            'title' => "Notices | Let's Go China"
        ]);
    }
}
