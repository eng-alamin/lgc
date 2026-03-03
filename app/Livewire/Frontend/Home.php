<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

use App\Models\Section;
use App\Models\Visa as VisaModel;
use App\Models\Slider as SliderModel;
use App\Models\Feature as FeatureModel;
use App\Models\Essential as EssentialModel;
use App\Models\Province as ProvinceModel;
use App\Models\Choose as ChooseModel;
use App\Models\Faq as FaqModel;
use App\Models\Testimonial as TestimonialModel;
use App\Models\Logo as LogoModel;
use App\Models\Blog as BlogModel;
use App\Models\Appointment as AppointmentModel;
use App\Models\Banner;

class Home extends Component
{
    public function render()
    {
        $sections = Section::get();
        $sliders = SliderModel::get();
        $visas = VisaModel::get();
        $faqs = FaqModel::take(4)->get();
        $features = FeatureModel::take(3)->get();
        $essentials = EssentialModel::get();
        $provinces = ProvinceModel::get();
        $chooses = ChooseModel::take(4)->get();
        $testimonials = TestimonialModel::latest()->take(4)->get();
        $logos = LogoModel::get();
        $blogs = BlogModel::latest()->take(4)->get();
        $banners = Banner::get();

        return view('livewire.frontend.home',[
            'sliders' => $sliders,
            'visas' => $visas,
            'faqs' => $faqs,
            'features' => $features,
            'essentials' => $essentials,
            'provinces' => $provinces,
            'chooses' => $chooses,
            'testimonials' => $testimonials,
            'logos' => $logos,
            'blogs' => $blogs,
            'sections' => $sections,
            'banners' => $banners,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Home | Let's Go China"
        ]);
    }

    public $date;
    public $time;
    public $service;
    public $name;
    public $email;
    public $phone;
    public $address;

    public function appointment()
    {
        $this->validate([
            'date' => 'required',
            'service' => 'required',
        ]);

        if (!auth()->check()) {
            return redirect()->route('login');
        }

        AppointmentModel::create([
            'client_id' => auth()->id(),
            'appointment_date' => $this->date,
            'appointment_time' => $this->time,
            'type' => 'online',
            'service' => $this->service,
        ]);

        return redirect()->route('home')->with('success', 'Appointment request submitted successfully!');
    }
}




