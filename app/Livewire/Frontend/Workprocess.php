<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\Workprocess as WorkprocessModel;

class Workprocess extends Component
{
    public function render()
    {
        $section = Section::where('type', 'process')->first();
        $data = WorkprocessModel::get();

        return view('livewire.frontend.workprocess',[
             'section' => $section,
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Work process | Let's Go China"
        ]);
    }
}
