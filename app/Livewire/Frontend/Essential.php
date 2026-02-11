<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\Essential as EssentialModel;

class Essential extends Component
{
    public function render()
    {
        $section = Section::where('type', 'essential')->first();
        $data = EssentialModel::get();

        return view('livewire.frontend.essential',[
            'section' => $section,
            'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Essentials | Let's Go China"
        ]);
    }
}
