<?php

namespace App\Livewire\Backend\Admin\Setting;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;

class Other extends Component
{
    public function render()
    {
        $data = Setting::first();
        $users = User::where('type', 'admin')->get();

        return view('livewire.backend.admin.setting.other', [
            'data' => $data,
            'users' => $users,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Settings | Let's Go China",
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp' => 'required',
            'notification_id' => 'required',
        ]);

        $data = Setting::first();
        $data->other = json_encode([
            'whatsapp' => $request->whatsapp,
            'notification_id' => $request->notification_id,
            'google_maps_api_key' => $request->google_maps_api_key,
        ]);
        $data->save();
        return redirect()->back()->with('success', 'Data Updated successfully.');
    }
}
