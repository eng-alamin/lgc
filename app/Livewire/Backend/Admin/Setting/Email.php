<?php

namespace App\Livewire\Backend\Admin\Setting;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Setting;
use Carbon\Carbon;

class Email extends Component
{
    public function render()
    {
        $data = Setting::first();

        return view('livewire.backend.admin.setting.email', [
            'data' => $data,
        ])
        ->layout('layouts.backend.app', [
            'title' => "Settings | Let's Go China",
        ]);
    }

        public function update(Request $request)
    {
        $request->validate([
            'smtp_host' => 'required',
            'smtp_port' => 'required',
            'smtp_username' => 'required',
            'smtp_password' => 'required',
            'smtp_encryption' => 'required',
            'smtp_from_name' => 'required',
            'smtp_from_email' => 'required',
            'smtp_to_email' => 'required',
            'smtp_cc_email' => 'required',
        ]);

        $data = Setting::first();
        $data->smtp = json_encode([
            'host' => $request->smtp_host,
            'port' => $request->smtp_port,
            'username' => $request->smtp_username,
            'password' => $request->smtp_password,
            'encryption' => $request->smtp_encryption,
            'name' => $request->smtp_from_name,
            'email' => $request->smtp_from_email,
            'to_email' => $request->smtp_to_email,
            'cc_email' => $request->smtp_to_email,
        ]);
        $data->save();
        return redirect()->back()->with('success', 'Data Updated successfully.');
    }
}
