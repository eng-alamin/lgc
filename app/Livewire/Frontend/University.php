<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\University as UniversityModel;

class University extends Component
{
    public function render()
    {
        $sections = Section::get();
        $data = UniversityModel::get();

        return view('livewire.frontend.university',[
             'sections' => $sections,
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Universities | Let's Go China"
        ]);

    }
}
