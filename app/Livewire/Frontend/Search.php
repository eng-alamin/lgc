<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog as BlogModel;
use App\Models\Section;
use Illuminate\Http\Request;

class Search extends Component
{
    public $q = '';

    protected $queryString = ['q'];

    public function updatedQ()
    {
        $this->resetPage();
    }

    public function render()
    {
        $sections = Section::get();

        $data = BlogModel::when($this->q, function ($query) {
                $query->where(function($q){
                    $q->where('title','like','%'.$this->q.'%')
                      ->orWhere('description','like','%'.$this->q.'%');
                });
            })
            ->latest()->get();
            // ->paginate(9);

        return view('livewire.frontend.search',[
             'sections' => $sections,
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
            'title' => "Search | Let's Go China"
        ]);
    }
}
