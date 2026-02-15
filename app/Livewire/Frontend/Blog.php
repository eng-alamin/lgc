<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog as BlogModel;
use App\Models\Section;
use App\Models\Faq;
use Illuminate\Http\Request;

class Blog extends Component
{
    public function render()
    {
        $sections = Section::get();
        $data = BlogModel::get();
        $latest_blogs = BlogModel::latest()->get();

        return view('livewire.frontend.blog',[
            'sections' => $sections,
            'data' => $data,
            'latest_blogs' => $latest_blogs,
            
        ])
        ->layout('layouts.frontend.app', [
                'title' => "Blog | Let's Go China"
            ]);
    }
}
