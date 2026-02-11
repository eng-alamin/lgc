<?php

namespace App\Livewire\Backend\Admin\Section;

use Livewire\Component;

use App\Models\Section;
use Illuminate\Http\Request;

class Funfact extends Component
{
    public function render()
    {   $section = Section::where('type', 'funfact')->first();
        $items = json_decode($section->json, true) ?? [];

        return view('livewire.backend.admin.section.funfact', [
            'section' => $section,
            'items'   => $items,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Funfacts | Let's Go China",
        ]);
    }

    public function sectionUpdate(Request $request, string $id)
    {
        $request->validate([
            'datavalue1' => 'required',
            'datatext1'  => 'required',
            'datavalue2' => 'required',
            'datatext2'  => 'required',
            'datavalue3' => 'required',
            'datatext3'  => 'required',
            'datavalue4' => 'required',
            'datatext4'  => 'required',
        ]); 

        try{
            $update = Section::findOrFail($id);
            
            $data = [
                [
                    'value' => $request->datavalue1,
                    'text'  => $request->datatext1,
                ],
                [
                    'value' => $request->datavalue2,
                    'text'  => $request->datatext2,
                ],
                [
                    'value' => $request->datavalue3,
                    'text'  => $request->datatext3,
                ],
                [
                    'value' => $request->datavalue4,
                    'text'  => $request->datatext4,
                ],
            ];
            $update->json = json_encode($data);
            $update->save();

            return redirect()->back()->with('success', 'Data is successfully updated');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Data update failed: ' . $e->getMessage());
        }
    }
}
