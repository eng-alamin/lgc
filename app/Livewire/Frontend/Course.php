<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Section as Section;
use App\Models\Course as CourseModel;

class Course extends Component
{
    public function render()
    {
        $sections = Section::get();
        $data = CourseModel::get();

        return view('livewire.frontend.course',[
             'sections' => $sections,
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Courses | Let's Go China",
            'seo' => [
                'title' => "Course | Let's Go China",
                'description' => config('setting.detail'),
                'image' => asset(config('setting.logo')),
                'url' => url('/'),
                'type' => 'website',
            ],
        ]);

    }
}
