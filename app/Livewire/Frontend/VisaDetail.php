<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Visa as VisaModel;
use App\Models\Section;
use App\Models\Faq;
use App\Models\Banner;

class VisaDetail extends Component
{
    public $visa;

    public function mount($id)
    {
        $this->visa = VisaModel::find($id);
    }

    public function render()
    {
        $sections = Section::get();
        $visas = VisaModel::get();
        $faqs = Faq::get();
        $banners = Banner::get();

        return view('livewire.frontend.visa-detail',[
             'visas' => $visas,
             'sections' => $sections,
             'faqs' => $faqs,
             'banners' => $banners,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Visa Details | Let's Go China",
            'seo' => $this->essential->seo,
        ]);
    }
}
