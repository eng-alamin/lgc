<?php

namespace App\Livewire\Backend\Admin\Setting;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;

class Meta extends Component
{
    public function render()
    {
        $data = Setting::first();

        return view('livewire.backend.admin.setting.meta', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Settings | Let's Go China",
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keyword' => 'required',
        ]);

        $data = Setting::first();
        $data->meta = json_encode([
            'title' => $request->title,
            'description' => $request->description,
            'keyword' => $request->keyword,
        ]);
        $data->save();
        return redirect()->back()->with('success', 'Data Updated successfully.');
    }
}
