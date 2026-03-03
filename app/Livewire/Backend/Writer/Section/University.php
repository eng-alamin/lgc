<?php

namespace App\Livewire\Backend\Writer\Section;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Http\Request;

class University extends Component
{
    public function render()
    {    $section = Section::where('type', 'university')->first();

        return view('livewire.backend.writer.section.university', [
            'section' => $section,
        ])
        ->layout('layouts.writer.app', [
            'title' => "University | Let's Go China",
        ]);
    }

    public function sectionUpdate(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
        ]);

        try{
            $update = Section::findOrFail($id);
            $update->name = $request->name;
            $update->title = $request->title;
            $update->save();

            return redirect()->back()->with('success', 'Data is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data update failed: ' . $e->getMessage());
        }
    }
}
