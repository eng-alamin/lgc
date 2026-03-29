<?php

namespace App\Livewire\Frontend\Client;

use Livewire\Component;
use App\Models\Notice;

class NoticeComponent extends Component
{
    public function render()
    {
        $notices = Notice::latest()->get();

        return view('livewire.frontend.client.notice-component',[
            'notices' => $notices,
        ])        
        ->layout('layouts.client.app', [
            'title' => "Notices | Let's Go China"
        ]);
    }
}
