<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog as BlogModel;
use App\Models\Section;
use App\Models\Faq;

class BlogDetail extends Component
{
    public $blog;

    public function mount($id)
    {
        $this->blog = BlogModel::find($id);
    }

    public function render()
    {
        $sections = Section::get();
        $latest_blogs = BlogModel::latest()->get();
        $faqs = Faq::get();

        return view('livewire.frontend.blog-detail',[
             'sections' => $sections,
             'latest_blogs' => $latest_blogs,
             'faqs' => $faqs,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Blog Details | Let's Go China"
        ]);
    }
}
