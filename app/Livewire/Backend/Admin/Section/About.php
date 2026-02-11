<?php

namespace App\Livewire\Backend\Admin\Section;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Http\Request;

class About extends Component
{
    public function render()
    {    $section = Section::where('type', 'about')->first();

        return view('livewire.backend.admin.section.about', [
            'section' => $section,
        ])
        ->layout('layouts.backend.app', [
            'title' => "About | Let's Go China",
        ]);
    }

    public function sectionUpdate(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        try{
            $update = Section::findOrFail($id);
            $update->name = $request->name;
            $update->title = $request->title;
            $update->description = $request->description;
            $update->link = $request->link;
            $update->save();

            return redirect()->back()->with('success', 'Data is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data update failed: ' . $e->getMessage());
        }
    }
}
