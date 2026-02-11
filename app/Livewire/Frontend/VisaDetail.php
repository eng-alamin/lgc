<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Visa as VisaModel;
use App\Models\Section;
use App\Models\Faq;

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

        return view('livewire.frontend.visa-detail',[
             'visas' => $visas,
             'sections' => $sections,
             'faqs' => $faqs,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Visa Details | Let's Go China"
        ]);
    }
}
