<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Blog as BlogModel;

class Blog extends Component
{
    public function render()
    {
        $data = BlogModel::get();

        return view('livewire.frontend.blog',[
             'data' => $data,
        ])
        ->layout('layouts.frontend.app', [
                'title' => "Blog | Let's Go China"
            ]);
    }
}
