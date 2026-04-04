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
        $data = BlogModel::latest()->get();
        $latest_blogs = BlogModel::latest()->get();

        return view('livewire.frontend.blog',[
            'sections' => $sections,
            'data' => $data,
            'latest_blogs' => $latest_blogs,
            
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Blogs | Let's Go China",
            'seo' => [
                'title' => "Blogs | Let's Go China",
                'description' => config('setting.detail'),
                'image' => asset(config('setting.logo')),
                'url' => url('/'),
                'type' => 'website',
            ],
        ]);
    }
}
