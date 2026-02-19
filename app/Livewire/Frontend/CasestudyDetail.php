<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Casestudy as CasestudyModel;
use App\Models\Section;
use App\Models\Faq;
use App\Models\Banner;

class CasestudyDetail extends Component
{
    public $case;

    public function mount($id)
    {
        $this->case = CasestudyModel::find($id);
    }

    public function render()
    {
        $sections = Section::get();
        $cases = CasestudyModel::get();
        $faqs = Faq::get();
        $banners = Banner::get();

        return view('livewire.frontend.casestudy-detail',[
             'cases' => $cases,
             'sections' => $sections,
             'faqs' => $faqs,
             'banners' => $banners,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Case Study Details | Let's Go China"
        ]);
    }
}
