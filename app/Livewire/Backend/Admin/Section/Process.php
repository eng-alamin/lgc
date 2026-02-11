<?php

namespace App\Livewire\Backend\Admin\Section;

use Livewire\Component;
use App\Models\Section;
use Illuminate\Http\Request;

class Process extends Component
{
    public function render()
    {    $section = Section::where('type', 'process')->first();

        return view('livewire.backend.admin.section.process', [
            'section' => $section,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Process | Let's Go China",
        ]);
    }

    public function sectionUpdate(Request $request, string $id)
    {
        $request->validate([
            // 'file' => 'file',
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'link' => 'required',
        ]);

        try{
            $update = Section::findOrFail($id);
            // if($request->file) {
            //     $fileName = time().'.'.$request->file->getClientOriginalExtension();
            //     $path = $request->file->storeAs('sections', $fileName, 'public');
            //     $fileData = '/storage/'.$path;
            //     $update->file = $fileData;
            // }
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
