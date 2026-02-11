<?php

namespace App\Livewire\Backend\Admin\Section;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Http\Request;

class Subscriber extends Component
{
    public function render()
    {    $section = Section::where('type', 'subscriber')->first();

        return view('livewire.backend.admin.section.subscriber', [
            'section' => $section,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Subscriber | Let's Go China",
        ]);
    }

    public function sectionUpdate(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
        ]);

        try{
            $update = Section::findOrFail($id);
            $update->title = $request->title;
            $update->save();

            return redirect()->back()->with('success', 'Data is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data update failed: ' . $e->getMessage());
        }
    }
}
