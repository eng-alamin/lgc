<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\About as AboutModel;
use App\Models\Choose as ChooseModel;
use App\Models\Team as TeamModel;
use App\Models\Workprocess as WorkprocessModel;
use App\Models\Testimonial as TestimonialModel;


class About extends Component
{
    public function render()
    {
        $sections = Section::get();
        $chooses = ChooseModel::take(3)->get();
        $teams = TeamModel::take(3)->get();
        $processes = WorkprocessModel::take(3)->get();
        $testimonials = TestimonialModel::latest()->take(4)->get();

        return view('livewire.frontend.about',[
            'sections' => $sections,
            'chooses' => $chooses,
            'teams' => $teams,
            'processes' => $processes,
            'testimonials' => $testimonials,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "About Us | Let's Go China"
        ]);
    }
}
