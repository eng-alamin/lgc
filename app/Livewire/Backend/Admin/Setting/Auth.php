<?php

namespace App\Livewire\Backend\Admin\Setting;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;

class Auth extends Component
{
    public function render()
    {
        $data = Setting::first();

        return view('livewire.backend.admin.setting.auth', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Settings | Let's Go China",
        ]);
    }

        public function update(Request $request)
    {
        $data = Setting::first();
        if ($request->auth_bg_image) {
            $fileName = Carbon::now()->timestamp. '.' .$request->auth_bg_image->extension();
            $path = $request->auth_bg_image->storeAs('admin/bg', $fileName, 'public');
            $fileData = 'storage/'.$path;
            $data->auth_bg_image = $fileData;
        }
        if ($request->auth_fg_image) {
            $fileName = Carbon::now()->timestamp. '.' .$request->auth_fg_image->extension();
            $path = $request->auth_fg_image->storeAs('admin/fg', $fileName, 'public');
            $fileData = 'storage/'.$path;
            $data->auth_fg_image = $fileData;
        }

        $data->auth_title = $request->auth_title;
        $data->auth_detail = $request->auth_detail;
        $data->google = json_encode([
            'client_id' => $request->google_client_id,
            'client_secret' => $request->google_client_secret,
            'callback_url' => $request->google_callback_url,
        ]);
        $data->facebook = json_encode([
            'client_id' => $request->facebook_client_id,
            'client_secret' => $request->facebook_client_secret,
            'callback_url' => $request->facebook_callback_url,
        ]);
        $data->socialite = $request->socialite;
        $data->save();
        return redirect()->back()->with('success', 'Data Updated successfully.');
    }
}
