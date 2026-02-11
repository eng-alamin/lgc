<?php

namespace App\Livewire\Backend\Admin\Setting;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;

class App extends Component
{
    public function render()
    {
        $data = Setting::first();

        return view('livewire.backend.admin.setting.app', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Settings | Let's Go China",
        ]);
    }

    public function update(Request $request)
    {
        $data = Setting::first();
        $data->name = $request->name;
        $data->detail = $request->detail;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->fax = $request->fax;
        if ($request->logo) {
            $fileName = Carbon::now()->timestamp. '.' .$request->logo->extension();
            $path = $request->logo->storeAs('admin/logo', $fileName, 'public');
            $fileData = '/storage/'.$path;
            $data->logo = $fileData;
        }
        if ($request->favicon) {
            $fileName = Carbon::now()->timestamp. '.' .$request->favicon->extension();
            $path = $request->favicon->storeAs('admin/favicon', $fileName, 'public');
            $fileData = '/storage/'.$path;
            $data->favicon = $fileData;
        }
        $data->address = $request->address;
        $data->time = $request->time;
        $data->website = $request->website;
        $data->social = json_encode([
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'x' => $request->x,
            'linkedin' => $request->linkedin,
        ]);
        $data->save();
        return redirect()->back()->with('success', 'Data Updated successfully.');
    }
}
