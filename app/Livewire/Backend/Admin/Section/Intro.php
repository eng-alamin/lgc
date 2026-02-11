<?php

namespace App\Livewire\Backend\Admin\Section;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Intro extends Component
{
    public function render()
    {    $section = Section::where('type', 'intro')->first();

        return view('livewire.backend.admin.section.intro', [
            'section' => $section,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Intro | Let's Go China",
        ]);
    }

    public function sectionUpdate(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try{
            $update = Section::findOrFail($id);
            $update->name = $request->name;
            $update->title = $request->title;
            $update->description = $request->description;

            if ($request->hasFile('file')) {
                if ($update->file && Storage::disk('public')->exists($update->file)) {
                    Storage::disk('public')->delete($update->file);
                }

                $fileName = Carbon::now()->timestamp . '.' . $request->file->getClientOriginalExtension();
                $path = $request->file->storeAs('intro', $fileName, 'public');
                $update->file = '/storage/' . $path;
            }

            $update->save();

            return redirect()->back()->with('success', 'Data is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data update failed: ' . $e->getMessage());
        }
    }
}
