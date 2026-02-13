<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Essential as EssentialModel;
use App\Models\Section;
use App\Models\Faq;

class EssentialDetail extends Component
{
        public $essential;

    public function mount($id)
    {
        $this->essential = EssentialModel::find($id);
    }

    public function render()
    {
        $sections = Section::get();
        $essentials = EssentialModel::get();
        $faqs = Faq::get();

        return view('livewire.frontend.essential-detail',[
             'essentials' => $essentials,
             'sections' => $sections,
             'faqs' => $faqs,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Essential Details | Let's Go China"
        ]);
    }
}
