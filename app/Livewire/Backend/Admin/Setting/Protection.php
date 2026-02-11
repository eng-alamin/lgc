<?php

namespace App\Livewire\Backend\Admin\Setting;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;

class Protection extends Component
{
    public function render()
    {
        $data = Setting::first();

        return view('livewire.backend.admin.setting.protection', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Settings | Let's Go China",
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'lifetime' => 'required',
        ]);

        $data = Setting::first();
        $data->protection = json_encode([
            'password' => $request->password,
            'lifetime' => $request->lifetime,
        ]);
        $data->save();
        return redirect()->back()->with('success', 'Data Updated successfully.');
    }
}
